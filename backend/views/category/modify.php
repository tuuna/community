<div class="result-wrap">
    <div class="result-content">
        <?php
        use yii\bootstrap\ActiveForm;
        use yii\helpers\Html;
        $form = ActiveForm::begin();

        echo $form->field($model,'catename')->textInput(['value' => $cateInfo->catename]);
        echo $form->field($model,'cateid')->hiddenInput(['value' => $cateInfo->cateid])->label(false);

        ?>

        <tr>
            <th>
                <?php echo Html::submitButton('修改', ['class' => 'btn-glow primary']); ?>
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