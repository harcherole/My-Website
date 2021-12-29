
<?php $title = "Partage de codes sources"; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
    <div id="main-content-share-code">
        <form action="" autocomplete="off" method="post">
            <textarea name="code" id="code" placeholder="Entrer votre code ici..." required="required"
                      onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}">
            <?= e($code); ?></textarea>

            <div class="btn-group nav">
                <a href="share_code.php" class="btn btn-danger">Tout effacer!</a>
                <input type="submit" name="save" class="btn btn-success" value="Enregistrer"/>
            </div>
        </form>
    </div><!-- /.container -->
</div>
