<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_FrontMasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Utilities.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Comments.php");
require_once(CLASS_PATH . "Class_Utilities.php");

/**
 *
 * @version
 * @author pedro
 */

$db = new Db();

$thumb = "images/calendar.png";
$title = "Calend&aacute;rio";

ob_clean();
ob_start();
?>
    <link rel="stylesheet" href="//c.tadst.com/common/cal2.css" type="text/css">

<?php
$customHead = ob_get_clean();

ob_clean();    
ob_start();

?>

    <div id="calarea">
        <!-- <p class="c pn">&lt;2010 | <a href="cal2012.html" title="2012">2012&gt;</a></p> -->
        <div id="ct1"><h1>2011</h1></div>
        <table id="mct1" class="ct1 cl15 cp6 cc4 cd3 cg4 cf7 ci7 cu6 cj4 wa" cellspacing="0">
            <tbody>
                <tr><th>Janeiro</th><td class="cz"></td><th>Fevereiro</th><td class="cz"></td><th>Março</th></tr>
                <tr>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody>
                                <tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class=" minititle">1</td><td class="cr">2</td></tr>
                                <tr><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td class="cr">9</td></tr>
                                <tr><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td class="cr">16</td></tr>
                                <tr><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td class="cr">23</td></tr>
                                <tr><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td><td class="cr">30</td></tr>
                                <tr class="cb"><td>31</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                            </tbody>
                        </table>   
                    </td>
                    <td class="cz"></td>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody>
                                <tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>&nbsp;</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td class="cr">6</td></tr>
                                <tr><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td class="cr">13</td></tr>
                                <tr><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td class="cr">20</td></tr>
                                <tr><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td class="cr">27</td></tr>
                                <tr><td>28</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                                <tr class="cb"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                            </tbody>
                        </table>                            
                    </td>
                    <td class="cz"></td>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody>
                                <tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>&nbsp;</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td class="cr">6</td></tr>
                                <tr><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td class="cr">13</td></tr>
                                <tr><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td class="cr">20</td></tr>
                                <tr><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td class="cr">27</td></tr>
                                <tr><td>28</td><td>29</td><td>30</td><td>31</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                                <tr class="cb"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                            </tbody>
                        </table>                            
                    </td>
                </tr>
                <tr class="ce"><td colspan="5"></td></tr>
                <tr><th>Abril</th><td class="cz"></td><th>Maio</th><td class="cz"></td><th>Junho</th></tr>
                <tr>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody><tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>1</td><td>2</td><td class="cr">3</td></tr>
                                <tr><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td class="cr">10</td></tr>
                                <tr><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td class="cr">17</td></tr>
                                <tr><td>18</td><td>19</td><td>20</td><td>21</td><td class=" minititle">22</td><td>23</td><td class=" minititle cr">24</td></tr>
                                <tr><td class=" minititle">25</td><td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td class="cr">&nbsp;</td></tr>
                                <tr class="cb"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                            </tbody>
                        </table>                            
                    </td>
                    <td class="cz"></td>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody>
                                <tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class=" minititle cr">1</td></tr>
                                <tr><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td class="cr">8</td></tr>
                                <tr><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td class="cr">15</td></tr>
                                <tr><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td class="cr">22</td></tr>
                                <tr><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td class="cr">29</td></tr>
                                <tr class="cb"><td>30</td><td>31</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                            </tbody>
                        </table>                            
                    </td><td class="cz"></td>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody>
                                <tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>1</td><td>2</td><td>3</td><td>4</td><td class="cr">5</td></tr>
                                <tr><td>6</td><td>7</td><td>8</td><td>9</td><td class=" minititle">10</td><td>11</td><td class="cr">12</td></tr>
                                <tr><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td class="cr">19</td></tr>
                                <tr><td>20</td><td>21</td><td>22</td><td class=" minititle">23</td><td>24</td><td>25</td><td class="cr">26</td></tr>
                                <tr><td>27</td><td>28</td><td>29</td><td>30</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                                <tr class="cb"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                            </tbody>
                        </table>                            
                    </td>
                </tr>
                <tr class="ce"><td colspan="5"></td></tr>
                <tr><th>Julho</th><td class="cz"></td><th>Agosto</th><td class="cz"></td><th>Setembro</th></tr>
                <tr>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody>
                                <tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>1</td><td>2</td><td class="cr">3</td></tr>
                                <tr><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td class="cr">10</td></tr>
                                <tr><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td class="cr">17</td></tr>
                                <tr><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td class="cr">24</td></tr>
                                <tr class="cb"><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td class="cr">31</td></tr>
                            </tbody>
                        </table>                            
                    </td><td class="cz"></td>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody>
                                <tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td class="cr">7</td></tr>
                                <tr><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td class="cr">14</td></tr>
                                <tr><td class=" minititle">15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td class="cr">21</td></tr>
                                <tr><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td class="cr">28</td></tr>
                                <tr class="cb"><td>29</td><td>30</td><td>31</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                            </tbody>
                        </table>                            
                    </td><td class="cz"></td>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody>
                                <tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>1</td><td>2</td><td>3</td><td class="cr">4</td></tr>
                                <tr><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td class="cr">11</td></tr>
                                <tr><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td class="cr">18</td></tr>
                                <tr><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td class="cr">25</td></tr>
                                <tr class="cb"><td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                            </tbody>
                        </table>                            
                    </td>
                </tr>
                <tr class="ce"><td colspan="5"></td></tr>
                <tr><th>Outubro</th><td class="cz"></td><th>Novembro</th><td class="cz"></td><th>Dezembro</th></tr>
                <tr>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody>
                                <tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>1</td><td class="cr">2</td></tr>
                                <tr><td>3</td><td>4</td><td class=" minititle">5</td><td>6</td><td>7</td><td>8</td><td class="cr">9</td></tr>
                                <tr><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td class="cr">16</td></tr>
                                <tr><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td class="cr">23</td></tr>
                                <tr><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td><td class="cr">30</td></tr>
                                <tr class="cb"><td>31</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                            </tbody>
                        </table>                            
                    </td><td class="cz"></td>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody>
                                <tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>&nbsp;</td><td class=" minititle">1</td><td>2</td><td>3</td><td>4</td><td>5</td><td class="cr">6</td></tr>
                                <tr><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td class="cr">13</td></tr>
                                <tr><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td class="cr">20</td></tr>
                                <tr><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td class="cr">27</td></tr>
                                <tr><td>28</td><td>29</td><td>30</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                                <tr class="cb"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                            </tbody>
                        </table>                            
                    </td><td class="cz"></td>
                    <td class="cbm cba tc cbo">
                        <table class="ca ca1">
                            <tbody>
                                <tr class="cl"><td>Seg</td><td>Ter</td><td>Qua</td><td>Qui</td><td>Sex</td><td>Sab</td><td class="cr">Dom</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class=" minititle">1</td><td>2</td><td>3</td><td class="cr">4</td></tr>
                                <tr><td>5</td><td>6</td><td>7</td><td class=" minititle">8</td><td>9</td><td>10</td><td class="cr">11</td></tr>
                                <tr><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td class="cr">18</td></tr>
                                <tr><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td class=" minititle cr">25</td></tr>
                                <tr><td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td><td class="cr">&nbsp;</td></tr>
                                <tr class="cb"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="cr">&nbsp;</td></tr>
                            </tbody>
                        </table>                            
                    </td>
                </tr>
            </tbody>
        </table>
    </div>    


<?php

$contents = ob_get_clean();

$page = new FrontMasterPage($title);
$page->setCustomHeadSection($customHead);
$page->setcustomMainSection($contents);
$page->show();

?>