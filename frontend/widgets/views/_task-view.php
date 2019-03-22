<?php use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


<div class="row <!--breadcrumb-->">
<!--    <form class="form-horizontal" role="form" method="post" action="view?id=<?/*=$model->id */?>">
-->
        <?php $form = ActiveForm::begin(); ?>


        <div class="caption">

            <div class="col-sm-7 col-md-7 ">
                <input type="text"
                       value="<?= $model->name ?>"
                       class="form-control"
                       placeholder="Заголовок"
                >
                <hr>
                <textarea rows="10" class="form-control discription-task"
                          placeholder="Описание..."
                ><?= $model->discription ?>
                </textarea>
            </div>
            <div class="col-sm-5 col-md-5">
                <blockquote>

                    <div class="form-group">
                        <label for="created_at" class="col-sm-4 control-label">от:</label>
                        <div class="col-sm-8">
                            <input type="text"
                                   value="<?= $model->created_at ?>"
                                   class="form-control"
                                   id="created_at"
                                   placeholder="от"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deadline" class="col-sm-4 control-label">до:</label>
                        <div class="col-sm-8">
                            <input type="date"
                                   value="<?= $model->deadline ?>"
                                   class="form-control"
                                   id="deadline"
                                   placeholder="до"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deadline" class="col-sm-4 control-label">статус:</label>
                        <div class="col-sm-8">
                            <select required id="deadline" class="form-control">
                                <option value="<?= $model->status_id ?>" selected><?= $model->status->name ?></option>
                                <?php
                                foreach ($taskStatuses as $key => $value){
                                  $deadline.= "<option value=\"{$key}\" >{$value}</option>";
                                }
                                ?>
                                <?= $deadline ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="creator" class="col-sm-4 control-label">Заказчик:</label>
                        <div class="col-sm-8">
                            <select required id="creator" class="form-control">
                                <option value="<?= $model->creator_id ?>" selected><?= $model->creator->username ?></option>
                                <?php
                                foreach ($user as $key => $value){
                                    $creator.= "<option value=\"{$key}\">{$value}</option>";
                                }
                                ?>
                                <?= $creator ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="respionsble" class="col-sm-4 control-label">Исполнитель:</label>
                        <div class="col-sm-8">
                            <select required id="respionsble" class="form-control">
                                <option value="<?= $model->responsible_id ?>" selected><?= $model->respionsble->username ?></option>
                                <?php
                                foreach ($user as $key => $value){
                                    $respionsble.= "<option value=\"{$key}\">{$value}</option>";
                                }
                                ?>
                                <?= $respionsble ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="col-sm-12 btn btn-success">Сохранить</button>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <!--    </form>
                    -->    </blockquote>

</div>






                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'discription')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'creator_id')->dropDownList($user, ['prompt'=>'укажите заказчика']) ?>

                <?= $form->field($model, 'responsible_id')->dropDownList($user, ['prompt'=>'укажите исполнителя']) ?>

                <?= $form->field($model, 'deadline')->textInput(['type' => 'date']) ?>

                <?= $form->field($model, 'status_id')->dropDownList($taskStatuses)  ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>


<!-- <p>
     <a href="#" class="btn btn-primary" role="button">Кнопка</a>
     <a href="#" class="btn btn-default" role="button">Кнопка</a>
 </p>-->
</div>
</div>
