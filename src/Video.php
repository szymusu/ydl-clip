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

namespace szymusu\YdlClip;


class Video
{
    private object $videoInfo;

    /**
     * @param string $videoId
     * @throws exception\VideoIDException
     * @throws exception\YoutubeDLException
     */
    public function __construct(string $videoId)
    {
        $this->videoInfo = (new YoutubeDL(new VideoID($videoId)))->execute();
    }

    public function getVideoId() : string { return $this->videoInfo->id; }
    public function getStreamUrl() : string { return $this->videoInfo->url; }
    public function getUploader() : string { return $this->videoInfo->uploader; }
    public function getTitle() : string { return $this->videoInfo->title; }
    public function getDescription() : string { return $this->videoInfo->description; }
    public function getDuration() : int { return $this->videoInfo->duration; }
    public function getViewCount() : int { return $this->videoInfo->view_count; }
    public function getLikeCount() : int { return $this->videoInfo->like_count; }
    public function getDislikeCount() : int { return $this->videoInfo->dislike_count; }
}