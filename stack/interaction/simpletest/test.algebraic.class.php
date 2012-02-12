<?php
// This file is part of Stack - http://stack.bham.ac.uk//
//
// Stack is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Stack is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Stack.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Unit tests for the STACK_Input_Algebra class.
 *
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(dirname(__FILE__) . '/../controller.class.php');


/**
 * Unit tests for STACK_Input_Algebra.
 *
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class STACK_Input_Algebra_test extends UnitTestCase {

    public function test_getXHTML_blank() {
        $el = STACK_Input_Controller::make_element('algebraic', 'ans1');
        $this->assertEqual('<input type="text" name="ans1" size="15" />',
                $el->getXHTML(false));
    }

    public function test_getXHTML_pre_filled() {
        $el = STACK_Input_Controller::make_element('algebraic', 'test');
        $el->setDefault('x+y');
        $this->assertEqual('<input type="text" name="test" size="15" value="x+y" />',
                $el->getXHTML(false));
    }

    public function test_getXHTML_pre_filled_nasty_input() {
        $el = STACK_Input_Controller::make_element('algebraic', 'test');
        $el->setDefault('x<y');
        $this->assertEqual('<input type="text" name="test" size="15" value="x&lt;y" />',
                $el->getXHTML(false));
    }

    public function test_getXHTML_max_length() {
        $el = STACK_Input_Controller::make_element('algebraic', 'test', null, null, 20);
        $el->setDefault('x+y');
        $this->assertEqual('<input type="text" name="test" size="15" value="x+y" maxlength="20" />',
                $el->getXHTML(false));
    }

    public function test_getXHTML_disabled() {
        $el = STACK_Input_Controller::make_element('algebraic', 'input');
        $this->assertEqual('<input type="text" name="input" size="15" readonly="readonly" />',
                $el->getXHTML(true));
    }
}
