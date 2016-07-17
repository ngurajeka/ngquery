<?php
/**
 * Query Module
 *
 * PHP Version 5.4.x
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
namespace Ng\Query;


/**
 * Query Module
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
interface ConditionInterface
{
    // get the conjunction of the condition
    // like (AND) / (OR)
    public function getConjunction();

    // extracting the condition as an array
    public function toArray();

    // extracting the condition as a string
    // receiving parameter useConjunction as bool
    public function toString($useConjunction);
}
