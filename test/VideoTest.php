<?php
/*
 * Copyright (c) 2021 Szymon Miłkowski
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

use szymusu\YdlClip\ClipTime;
use szymusu\YdlClip\exception\FFmpegException;
use szymusu\YdlClip\exception\VideoIDException;
use szymusu\YdlClip\exception\YoutubeDLException;
use szymusu\YdlClip\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    /**
     * @test
     * @dataProvider idsAndTitles
     * @param string $vid
     * @param string $title
     * @throws VideoIDException
     * @throws YoutubeDLException
     */
    public function constructingVideo_fetchesVideoData(string $vid, string $title)
    {
        $video = new Video($vid);
        self::assertEquals($vid, $video->getVideoId());
        self::assertEquals($title, $video->getTitle());
    }

    public function idsAndTitles(): array
    {
        return [
            ['dQw4w9WgXcQ', 'Rick Astley - Never Gonna Give You Up (Video)']
        ];
    }

    /**
     * @test
     * @dataProvider clipsToDownload
     * @param string $vid
     * @param ClipTime $clipTime
     * @param string $fileName
     * @throws FFmpegException
     * @throws VideoIDException
     * @throws YoutubeDLException
     */
    public function downloadClip_createsCorrectFile(string $vid, ClipTime $clipTime, string $fileName)
    {
        if (file_exists($fileName)) {
            unlink($fileName);
        }

        (new Video($vid))->downloadClip($clipTime, $fileName);

        $this->assertTrue(file_exists($fileName));
    }

    public function clipsToDownload(): array
    {
        return [
            ['a5WeOJHFz0o', new ClipTime(47.77, 56.244708), '../storage/cyberpunk.mkv'],
            ['nX1VQwg6jxU', new ClipTime(309.34, 309.982191), '../storage/zlikwidowac.mkv'],
            ['RTXS4MMngnA', new ClipTime(2193.239959, 2195.116521), '../storage/puff_ding_aaa.mkv'],
        ];
    }
}