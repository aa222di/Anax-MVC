<div class='grid comment-form'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->url->create($pageId) . '#comments'?>">
        <input type=hidden name="pageId" value="<?=$pageId?>">
        <fieldset>
        <legend><?=$action?></legend>
        <p class='toggler'><label>Comment:<br/><textarea name='content'><?=$content?></textarea></label></p>
        <div class='hidden'>
        <label>Name:<br/><input type='text' name='name' value='<?=$name?>'/></label>
        <label>Homepage:<br/><input type='text' name='web' value='<?=$web?>'/></label>
        <label>Email:<br/><input type='text' name='mail' value='<?=$mail?>'/></label>
        <p class=buttons>
        <?php if(!isset($id)): ?>
            <input type='submit' name='doCreate' value='Send comment' onClick="this.form.action = '<?=$this->url->create('comment/add')?>'"/>
            <input type='submit' name='doRemoveAll' value='Remove all comments' onClick="this.form.action = '<?=$this->url->create('comment/remove-all')?>'"/>
        <?php else: ?>
            <input type='submit' name='doEdit' value='Edit comment' onClick="this.form.action = '<?=$this->url->create('comment/edit') . '?id=' . $id?>'"/>
        </p>
        <?php endif; ?>
        </div>
        <output><?=$output?></output>
        </fieldset>
    </form>
</div>
