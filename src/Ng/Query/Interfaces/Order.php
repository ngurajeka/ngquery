<?php
/**
 * Order Interfaces
 *
 * PHP Version 5.4.x
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
namespace Ng\Query\Interfaces;


/**
 * Order Interfaces
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
interface Order
{
    const ORDER_ASC     = "ASC";
    const ORDER_DESC    = "DESC";

    /**
     * Extracting the order as an array
     *
     * @return array
     */
    public function toArray();

    /**
     * Extracting the order as a string
     * receive parameter useComma as bool
     *
     * @param bool $useComma Option to use comma or not
     *
     * @return string
     */
    public function toString($useComma);
}
