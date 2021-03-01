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


use OutOfBoundsException;

class ClipTime
{
    private float $start;
    private float $end;

    public function __construct(float $start, float $end)
    {
        $this->start = $start;
        $this->end = $end;

        if ($start < 0 || $end < 0)
        {
            throw new OutOfBoundsException('Timestamps cannot be negative');
        }
        if ($this->getDuration() <= 0)
        {
            throw new OutOfBoundsException('Duration must be a positive number');
        }
    }

    private function getDuration() : float
    {
        return $this->end - $this->start;
    }

    public function getStart() : float
    {
        return $this->start;
    }

    public function getEnd() : float
    {
        return $this->end;
    }
}