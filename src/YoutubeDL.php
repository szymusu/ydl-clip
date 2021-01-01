<?php
/*
 * Copyright (c) 2020 Szymon Miłkowski
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

namespace szymusu\YdlClip;


class YoutubeDL
{
    private string $videoId;
    private ClipTime $time;

    public function getVideoId(): string
    {
        return $this->videoId;
    }
    private function setVideoId(string $videoId): void
    {
        

        $this->videoId = $videoId;
    }

    public function __construct(string $videoId, $start, $end)
    {
        $this->videoId = escapeshellarg($videoId);
        $this->time = new ClipTime($start, $end);
    }

//    private function getVideoUrl() : string
//    {
//        $output = null; $exitCode = null;
//        exec('youtube-dl -f best --youtube-skip-dash-manifest -g '.$this->videoId, $output, $exitCode);
//    }
}