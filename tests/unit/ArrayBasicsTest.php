<?php

use Ahamed\JsPhp\JsArray;
use PHPUnit\Framework\TestCase;

class ArrayBasicsTest extends TestCase
{
	/** ------------- Test Data Providers ------------- */

	public function pushDataProvider()
	{
		return [
			[[], [1], 1],
			[[1, 2 ,3], [4], 4],
			[['Jan', 'Feb', 'Mar'], ['Apr', 'May'], 5],
			[['one' => 1, 'two' => 2, 'three' => 3], [4, 5, 6], 6],
			[['a', 'b', 'c', 'd'], [], 0]
		];
	}

	public function popDataProvider()
	{
		return [
			[[], null, []],
			[[1, 2 ,3], 3, [1, 2]],
			[['Jan', 'Feb', 'Mar'], 'Mar', ['Jan', 'Feb']],
			[['one' => 1, 'two' => 2, 'three' => 3], 3, ['one' => 1, 'two' => 2]],
			[['one' => 1, 'two' => 2, 'three' => 3, 4, 5, 6], 6, ['one' => 1, 'two' => 2, 'three' => 3, 4, 5]]
		];
	}

	public function shiftDataProvider()
	{
		return [
			[[], null, []],
			[[1, 2 ,3], 1, [2, 3]],
			[['Jan', 'Feb', 'Mar'], 'Jan', ['Feb', 'Mar']],
			[['one' => 1, 'two' => 2, 'three' => 3], 1, ['two' => 2, 'three' => 3]],
			[[4, 5, 6, 'one' => 1, 'two' => 2, 'three' => 3], 4, [5, 6, 'one' => 1, 'two' => 2, 'three' => 3]],
			[['one' => 1, 'two' => 2, 'three' => 3, 4, 5, 6], 1, ['two' => 2, 'three' => 3, 4, 5, 6]],
			[['one' => 1, 'two' => 2, 3, 4, 5, 'six' => 6], 1, ['two' => 2, 3, 4, 5, 'six' => 6]]
		];
	}

	public function unshiftDataProvider()
	{
		return [
			[[], [1], 1, [1]],
			[[2, 3], [1], 3, [1, 2, 3]],
			[[2, 3], [0, 1], 4, [0, 1, 2, 3]],
			[['Jan', 'Feb', 'Mar'], [''], 4, ['', 'Jan', 'Feb', 'Mar']],
			[['Jan', 'Feb', 'Mar'], [' '], 4, [' ', 'Jan', 'Feb', 'Mar']],
			[['one' => 1, 'two' => 2, 'three' => 3], [0], 4, [0, 'one' => 1, 'two' => 2, 'three' => 3]],
			[[4, 5, 6, 'one' => 1, 'two' => 2, 'three' => 3], [0, 4], 8, [0, 4, 4, 5, 6, 'one' => 1, 'two' => 2, 'three' => 3]],
			[['1' => 1, 'two' => 2, 'three' => 3, 4, 5, 6], [-3, -2, -1, 0], 10, [-3, -2, -1, 0, '4' => 1, 'two' => 2, 'three' => 3, 4, 5, 6]],
			[['one' => 1, 'two' => 2, 3, 4, 5, 'six' => 6], [0, 0, 0], 9, [0, 0, 0, 'one' => 1, 'two' => 2, 3, 4, 5, 'six' => 6]]
		];
	}

	public function joiningDataProvider()
	{
		return [
			[[], ',', ''],
			[[2, 3], '+', '2+3'],
			[[2, 3], ', ', '2, 3'],
			[[2, 3], ' ,', '2 ,3'],
			[['Jan', 'Feb', 'Mar'], ', ', 'Jan, Feb, Mar'],
			[['Jan', 'Feb', 'Mar'], ' + ', 'Jan + Feb + Mar'],
			[['one' => 1, 'two' => 2, 'three' => 3], null, '1,2,3'],
			[['one' => 1, 'two' => 2, 'three' => 3], ', ', '1, 2, 3'],
			[[4, 5, 6, 'one' => 1, 'two' => 2, 'three' => 3], ' + ', '4 + 5 + 6 + 1 + 2 + 3'],
			[[-3, -2, -1, 0, '1' => 1, 'two' => 2, 'three' => 3, 4, 5, 6], null, '-3,1,-1,0,2,3,4,5,6'],
			[[1, 2, 3, [4, 5, 6], 7, 8], null, '1,2,3,4,5,6,7,8'],
			[[1, 2, 3, [4, 5, 6], 7, 8], ' + ', '1 + 2 + 3 + 4,5,6 + 7 + 8'],
			[[[1, 2, 3], [4, 5, 6], [7, 8]], ' + ', '1,2,3 + 4,5,6 + 7,8'],
		];
	}

	public function sliceDataProvider()
	{
		return [
			[[], null, null, []],
			[[], 0, -1, []],
			[[], 0, 10, []],
			[[], -10, null, []],
			[[1, 2, 3], null, null, [1, 2, 3]],
			[[1, 2, 3], 0, 1, [1]],
			[[1, 2, 3, 4, 5], 2, null, [3, 4, 5]],
			[[1, 2, 3, 4, 5], 2, 4, [3, 4]],
			[[1, 2, 3, 4, 5, 6, 7], -1, null, [7]],
			[[1, 2, 3, 4, 5, 6, 7], 0, -1, [1, 2, 3, 4, 5, 6]],
			[[1, 2, 3, 4, 5, 6, 7], -1, -2, []],
			[[1, 2, 3, 4, 5, 6, 7], 0, -8, []],
			[[1, 2, 3, 4, 5, 6, 7], 6, null, [7]],
			[[1, 2, 3, 4, 5, 6, 7], 7, null, []],
			[['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4], null, null, ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4]],
			[['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4], 0, -1, ['one' => 1, 'two' => 2, 'three' => 3]],
			[['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4], 0, -5, []],
			[['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4], -5, -5, []],
			[['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4], -5, null, ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4]],
			[['one' => 1, 'two' => 2, 3, 4, 'five' => 5, 'six' => 6], 2, 4, [3, 4]],
			[['one' => 1, 'two' => 2, 3, 4, 'five' => 5, 'six' => 6], null, null, ['one' => 1, 'two' => 2, 3, 4, 'five' => 5, 'six' => 6]],
			[['one' => 1, 'two' => 2, 3, 4, 'five' => 5, 'six' => 6], -4, -2, [3, 4]],
		];
	}

	/**
	 * data, (start, end), pushValue, result, remaining
	 * The odd arrays are without insertion and the even
	 * ones with insertion.
	 */
	public function spliceDataProvider()
	{
		return [
			[
				[], [null, null], [], [], []
			],
			[
				[], [null, null], [11], [], [11]
			],
			[
				[], [0, -1], [], [], []
			],
			[
				[], [0, -1], [10, 20], [], [10, 20]
			],
			[
				[], [0, 10], [], [], []
			],
			[
				[], [0, 10], ['a', 'b', 'c'], [], ['a', 'b', 'c']
			],
			[
				[], [-10, null], [], [], []
			],
			[
				[], [-10, null], [1, 2, 3], [], [1, 2, 3]
			],
			[
				[1, 2, 3], [null, null],[], [], [1, 2, 3]
			],
			[
				[1, 2, 3], [null, null],[11], [], [11, 1, 2, 3]
			],
			[
				[1, 2, 3], [0, null], [], [1, 2, 3], []
			],
			[
				[1, 2, 3], [0, null], ['x', 'y', 5], [], ['x', 'y', 5, 1, 2, 3]
			],
			[
				[1, 2, 3, 4, 5], [2, null], [], [3, 4, 5], [1, 2]
			],
			[
				[1, 2, 3, 4, 5], [2, null], ['x', 'y'], [], [1, 2, 'x', 'y', 3, 4, 5]
			],
			[
				[1, 2, 3, 4, 5], [2, 4], [], [3, 4, 5], [1, 2]
			],
			[
				[1, 2, 3, 4, 5], [2, 4], ['x', 'y'], [3, 4, 5], [1, 2, 'x', 'y']
			],
			[
				[1, 2, 3, 4, 5, 6, 7], [-1, null], [], [7], [1, 2, 3, 4, 5, 6]
			],
			[
				[1, 2, 3, 4, 5, 6, 7], [-1, null], ['x', 'y'], [], [1, 2, 3, 4, 5, 6, 'x', 'y', 7]
			],
			[
				[1, 2, 3, 4, 5, 6, 7], [0, -1], ['a', 'b'], [], ['a', 'b', 1, 2, 3, 4, 5, 6, 7]
			],
			[
				[1, 2, 3, 4, 5, 6, 7], [-1, 0], [], [], [1, 2, 3, 4, 5, 6, 7]
			],
			[
				[1, 2, 3, 4, 5, 6, 7], [-1, 0], ['a', 'b'], [], [1, 2, 3, 4, 5, 6, 'a', 'b', 7]
			],
			[
				[1, 2, 3, 4, 5, 6, 7], [-8, 1], [], [1], [2, 3, 4, 5, 6, 7]
			],
			[
				[1, 2, 3, 4, 5, 6, 7], [-8, 1], ['x', 'y'], [1], ['x', 'y', 2, 3, 4, 5, 6, 7]
			],
			[
				[1, 2, 3, 4, 5, 6, 7], [6, null], [],  [7], [1, 2, 3, 4, 5, 6]
			],
			[
				[1, 2, 3, 4, 5, 6, 7], [6, null], ['x', 'y'],  [], [1, 2, 3, 4, 5, 6, 'x', 'y', 7]
			],
			[
				[1, 2, 3, 4, 5, 6, 7], [7, null], [], [], [1, 2, 3, 4, 5, 6, 7]
			],
			[
				[1, 2, 3, 4, 5, 6, 7], [7, null], ['a'], [], [1, 2, 3, 4, 5, 6, 7, 'a']
			],
			[
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4],
				[null, null],
				[],
				[],
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4]
			],
			[
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4],
				[null, null],
				['x', 'y'],
				[],
				['x', 'y', 'one' => 1, 'two' => 2, 'three' => 3, 'four' => 4]
			],
			[
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4],
				[0, -1],
				[],
				[],
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4]
			],
			[
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4],
				[0, -1],
				['x', 'y'],
				[],
				['x', 'y', 'one' => 1, 'two' => 2, 'three' => 3, 'four' => 4]
			],
			[
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4],
				[0, 4],
				[],
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4],
				[]
			],
			[
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4],
				[0, 4],
				['a', 'b', 10],
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4],
				['a', 'b', 10]
			],
			[
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4],
				[-2, 1],
				[],
				['three' => 3],
				['one' => 1, 'two' => 2, 'four' => 4]
			],
			[
				['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4],
				[-2, 1],
				['three'],
				['three' => 3],
				['one' => 1, 'two' => 2, 'three', 'four' => 4]
			],
			[
				['one' => 1, 'two' => 2, 3, 4, 'five' => 5, 'six' => 6],
				[2, 4],
				[],
				[3, 4, 'five' => 5, 'six' => 6],
				['one' => 1, 'two' => 2]
			],
			[
				['one' => 1, 'two' => 2, 3, 4, 'five' => 5, 'six' => 6],
				[2, 4],
				[100, 200],
				[3, 4, 'five' => 5, 'six' => 6],
				['one' => 1, 'two' => 2, 100, 200]
			]
		];
	}

	/** ------------- Test Functions ------------- */

	/**
	 * @dataProvider 	pushDataProvider()
	 */
	public function testPush($data, $push, $result)
	{
		$array = new JsArray($data);

		if (count($push) > 0)
		{
			$this->assertEquals($result, $array->push(...$push));
		}
		else
		{
			$this->expectException(\InvalidArgumentException::class);
			$this->expectExceptionMessage('You must have to pass at least one value to push');
			$this->assertEquals($result, $array->push(...$push));
		}
	}

	/**
	 * @dataProvider 	popDataProvider()
	 */
	public function testPop($data, $result, $remaining)
	{
		$array = new JsArray($data);

		$this->assertEquals($result, $array->pop());
		$this->assertEquals($array->get(), $remaining);
	}

	/**
	 * @dataProvider 	shiftDataProvider()
	 */
	public function testShift($data, $result, $remaining)
	{
		$array = new JsArray($data);

		$this->assertEquals($result, $array->shift());
		$this->assertEquals($array->get(), $remaining);
	}

	/**
	 * @dataProvider	unshiftDataProvider()
	 */
	public function testJsArrayUnshift($data, $props, $result, $remaining)
	{
		$array = new JsArray($data);

		$this->assertEquals($result, $array->unshift(...$props));
		$this->assertEquals($array->get(), $remaining);
	}

	/**
	 * @dataProvider	joiningDataProvider()
	 */
	public function testJsArrayJoin($data, $separator, $result)
	{
		$array = new JsArray($data);

		if (\is_null($separator))
		{
			$this->assertEquals($result, $array->join());
		}
		else
		{
			$this->assertEquals($result, $array->join($separator));
		}
	}

	/**
	 * @dataProvider	sliceDataProvider()
	 */
	public function testJsArraySlice($data, $start, $end, $result)
	{
		$array = new JsArray($data);

		$this->assertEquals((new JsArray($result)), $array->slice($start, $end));
	}

	/**
	 * @dataProvider	spliceDataProvider()
	 */
	public function testJsArraySplice($data, $props, $pushValues, $result, $remaining)
	{
		$array = new JsArray($data);

		if (!empty($pushValues))
		{
			$this->assertEquals((new JsArray($result)), $array->splice(...$props, ...$pushValues));
			$this->assertEquals((new JsArray($remaining)), $array);
		}
		else
		{
			$this->assertEquals((new JsArray($result)), $array->splice(...$props));
			$this->assertEquals((new JsArray($remaining)), $array);
		}
	}
}