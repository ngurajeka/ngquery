<?php
/**
 * Condition Interfaces
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
 * Condition Interfaces
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
interface Condition
{
    const CON_AND   = "AND";
    const CON_OR    = "OR";

    /**
     * Get the conjunction of the condition
     * like (AND) / (OR)
     *
     * @return string
     */
    public function getConjunction();

    /**
     * Extracting the condition as an array
     *
     * @return array
     */
    public function toArray();

    /**
     * Extracting the condition as a string
     * receiving parameter useConjunction as bool
     *
     * @param bool $useConjunction Option to use conjunction or not
     *
     * @return string
     */
    public function toString($useConjunction);
}
