<div class="result-wrap">
    <div class="result-content">
        <?php
        use yii\bootstrap\ActiveForm;
        use Yii;
        use yii\helpers\Html;
        $form = ActiveForm::begin();

                        echo $form->field($model,'username')->textInput();


                        echo $form->field($model,'password')->passwordInput();

                        echo $form->field($model,'stuid')->textInput();

                        echo $form->field($model,'email')->textInput();

                ?>

                <tr>
                    <th>
                       <?php echo Html::submitButton('添加', ['class' => 'btn-glow primary']); ?>
                    </th>
                    <td>
                        <?php echo Html::resetButton('取消', ['class' => 'reset']); ?>
                    </td>
                </tr>

                </tbody>
            </table>
        <?php ActiveForm::end();?>

    </div>
</div>

</div>