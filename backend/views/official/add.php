<div class="result-wrap">
    <div class="result-content">
        <?php
        use yii\bootstrap\ActiveForm;
        use Yii;
        use yii\helpers\Html;
        $form = ActiveForm::begin();

        echo $form->field($model,'offname')->textInput();

        echo $form->field($model,'offemail')->textInput();

        echo $form->field($model,'manager')->textInput(['placeholder' => '若有多个人，请用逗号分割']);

        echo $form->field($model,'offphone')->textInput();






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