<div id="commentswrapper">
    <div id="commentscontainer">
        <br/>
        <div id="commentslist">
            <h1>Coment&aacute;rios:</h1>
            <?php
                $sqlcomments = "SELECT name, comment, lastupdate FROM comments where pagid=" . $this->_pagid;
                $db = new Db();
                $resultscomments = $db->dbQuery($sqlcomments);
                while ($com = $db->dbGetRow($resultscomments)) {
                    echo '<div class="row"><h2>' . $com->name . ' </h2>';
                    echo '<div class="comment"><p>' . $com->comment . '</p></div>';
                    echo '<h3>' . Utilities::convertDate2String($com->lastupdate) . '</h3></div>';
                }
            ?>
        </div>
        <div id="leaveComment">
            <form name="myform" action="#" method="post">
                <input type="hidden" name="pagid" value="<?php echo $this->_pagid;?>">
                <div class="row"><h2>Nome:</h2><input type="text" name="name"></div>
                <div class="row"><h2>Coment&aacute;rio:</h2><textarea name="comment" rows="5"></textarea></div>
                <div style="padding-left: 100px;">
                    <input type="image" src="images/okbtn.png" onmouseover="this.src='images/okbtn_hover.png'" onmouseout="this.src='images/okbtn.png'" alt="submit button" />
                </div>
            </form>
        </div>
        <br/>
    </div>
</div>