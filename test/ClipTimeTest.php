<?php
/*
 * Copyright (c) 2020Szymon Miłkowski
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

use PHPUnit\Framework\TestCase;
use szymusu\YdlClip\ClipTime;

class ClipTimeTest extends TestCase
{
    /**
     * @test
     * @dataProvider invalidTimestamps
     */
    public function constructor_ThrowsOutOfBounds_onInvalidTimestamps($start, $end)
    {
        $this->expectException(\OutOfBoundsException::class);
        new ClipTime($start, $end);
    }
    public function invalidTimestamps(): array
    {
        return [
            [0, 0],
            [1, 1],
            [1, 0],
            [-1, 0],
            [-1, -1],
            [0, -1],
            [0, -1],
            [0, ClipTime::MAX_DURATION + 0.0001],
            [1212, ClipTime::MAX_DURATION + 1212.1],
            [1212, 1212 + ClipTime::MAX_DURATION * 2],
        ];
    }

    /**
     * @test
     * @dataProvider invalidTypes
     */
    public function constructor_ThrowsTypeError_whenArgumentIsNotNumber($start, $end)
    {
        $this->expectException(\TypeError::class);
        new ClipTime($start, $end);
    }
    public function invalidTypes(): array
    {
        return [
            [null, 99],
            ["rampampam", 99],
            [0, null],
            [0, "siajajaja"],
            [0, new ClipTime(0, 1)],
        ];
    }
}
