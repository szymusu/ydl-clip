pipeline {
    agent any

    stages {
        stage('Clean') {
            steps {
                sh 'docker system prune -f --volumes'
            }
        }

        stage('Clone') {
            steps {
                sh 'if [ ! -d MDO2025_INO ]; then git clone -b SM418114 --single-branch https://github.com/InzynieriaOprogramowaniaAGH/MDO2025_INO; fi'
            }
        }

        stage('Pull') {
            steps {
                sh 'cd MDO2025_INO && git pull'
            }
        }

        stage('Dependencies') {
            steps {
                sh 'docker build -t ydl-clip -f ./MDO2025_INO/ITE/GCL05/SM418114/ydl-clip/Dockerfile.run .'
            }
        }

        stage('Build') {
            steps {
                sh 'docker build --no-cache -t ydl-clip-build -f ./MDO2025_INO/ITE/GCL05/SM418114/ydl-clip/Dockerfile.build .'
                sh 'docker volume create phar'
                sh 'docker build -t ydl-clip-phar -f ./MDO2025_INO/ITE/GCL05/SM418114/ydl-clip/Dockerfile.phar .'
                sh 'docker run --name phar --rm -t -v phar:/ydl-clip/build/ ydl-clip-phar'
            }
        }

        stage('Test') {
            steps {
                sh 'docker build -t ydl-clip-test -f ./MDO2025_INO/ITE/GCL05/SM418114/ydl-clip/Dockerfile.test .'
                sh 'docker run --rm -t ydl-clip-test'
            }
        }

        stage('Deploy') {
            steps {
                sh 'docker run --rm -v phar:/phar ydl-clip bash -c "/phar/ydl-clip.phar HVX_4dZSy7E"'
            }
        }

        stage('Publish') {
            steps {
                script {
                    def version = params.VERSION
                    sh 'docker run --name publish-phar -v phar:/phar ydl-clip'
                    sh "docker cp publish-phar:/phar/ydl-clip.phar ./ydl-clip-${version}.phar"
                    sh 'docker rm publish-phar'
                    archiveArtifacts artifacts: "ydl-clip-${version}.phar", allowEmptyArchive: false
                }
            }
        }
    }
}
