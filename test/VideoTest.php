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

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use szymusu\YdlClip\ClipTime;
use szymusu\YdlClip\exception\FFmpegException;
use szymusu\YdlClip\exception\VideoIDException;
use szymusu\YdlClip\exception\YoutubeDLException;
use szymusu\YdlClip\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    /**
     * @throws VideoIDException
     * @throws YoutubeDLException
     */
    #[Test]
    #[DataProvider('idsAndTitles')]
    public function constructingVideo_fetchesVideoData(string $vid, string $title)
    {
        $video = new Video($vid);
        self::assertEquals($vid, $video->getVideoId());
        self::assertEquals($title, $video->getTitle());
    }

    public static function idsAndTitles(): array
    {
        return [
            ['dQw4w9WgXcQ', 'Rick Astley - Never Gonna Give You Up (Official Video) (4K Remaster)'],
            ['QyJZzq0v7Z4', 'Why Isn\'t Functional Programming the Norm? – Richard Feldman'],
            ['kzOsK7GwcYc', 'How To Die in 0.5 Seconds, Now in 60 FPS! | Minecraft Crystal PvP Montage'],
        ];
    }

    /**
     * @throws FFmpegException
     * @throws VideoIDException
     * @throws YoutubeDLException
     */
    #[Test]
    #[DataProvider('clipsToDownload')]
    #[Group("download")]
    public function downloadClip_createsCorrectFile(string $vid, ClipTime $clipTime, string $fileName)
    {
        if (file_exists($fileName)) {
            unlink($fileName);
        }

        new Video($vid)->downloadClip($clipTime, $fileName);

        $this->assertTrue(file_exists($fileName));
    }

    public static function clipsToDownload(): array
    {
        return [
            ['a5WeOJHFz0o', new ClipTime(47.77, 56.244708), '../storage/cyberpunk.mkv'],
            ['nX1VQwg6jxU', new ClipTime(309.34, 309.982191), '../storage/zlikwidowac.mkv'],
            ['RTXS4MMngnA', new ClipTime(2193.239959, 2195.116521), '../storage/puff_ding_aaa.mkv'],
        ];
    }
}