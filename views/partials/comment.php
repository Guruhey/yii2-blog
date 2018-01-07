<? if(!empty($comments)): ?>
    <? foreach ($comments as $comment):?>
        <div class="bottom-comment">
            <div class="comment-img">
                <img style="width: 50px;height: 50px;" class="img-circle" src="<?=$comment->user->photo?>" alt="">
            </div>

            <div class="comment-text">
                <a href="#" class="replay btn pull-right"> Replay</a>
                <h5><?=$comment->user->name?></h5>

                <p class="comment-date">
                    <?=$comment->getDate();?>
                </p>


                <p class="para"><?=$comment->text;?></p>
            </div>
        </div>
    <?endforeach;?>
<?endif;?>
<?php if(!Yii::$app->user->isGuest):?>
    <div class="leave-comment"><!--leave comment-->
        <?php if(Yii::$app->session->getFlash('comment')):?>
            <div class="alert alert-seccess" role="alert">
                <?=Yii::$app->session->getFlash('comment');?>
            </div>
        <?endif;?>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action' => ['site/comment', 'id'=>$article->id],
            'options' => ['class' =>'form-horizontal contact-form', 'role'=>'form']]);?>
        <div class="form-group">
            <div class="col-md-12">
                <?=$form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false);?>
            </div>
        </div>
        <button type="submit" class="btn send-btn">Post Comment</button>
        <?php \yii\widgets\ActiveForm::end();?>
    </div>
<?php endif;?>