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

use szymusu\YdlClip\exception\VideoIDException;
use szymusu\YdlClip\VideoID;
use PHPUnit\Framework\TestCase;

class VideoIDTest extends TestCase
{
    /**
     * @test
     * @dataProvider badVideoIds
     */
    public function constructor_throwsInvalidArgument_onBadVideoId($videoId)
    {
        $this->expectException(VideoIDException::class);
        new VideoID($videoId);
    }
    public function badVideoIds() : array
    {
        return [
            ["aaa"],
            ["dQw4w9WgXcQq"],
            ["dQw4w9WgXc"],
            ["_-_-_-_-_-"],
            ["0; shutdown now"],
            ["dQw4w9W%XcQ"],
            ["d+w4w9WgXcQ"],
            ["dQw4 9WgXcQ"],
            ["dQw4w/WgXcQ"],
        ];
    }

    /**
     * @test
     * @dataProvider goodVideoIds
     * @throws VideoIDException
     */
    public function constructor_acceptsValidVideoId($videoId)
    {
        new VideoID($videoId);
        $this->expectNotToPerformAssertions();
    }
    public function goodVideoIds() : array
    {
        return [
            ["dQw4w9WgXcQ"],
            ["goodVideoId"],
            ["gocwRvLhDf8"],
            ["rsUTtpb3k-w"],
            ["-----------"],
        ];
    }
}
