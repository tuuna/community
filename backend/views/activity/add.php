<div class="result-wrap">
    <div class="result-content">
        <?php
        use yii\bootstrap\ActiveForm;
        use Yii;
        use yii\helpers\Html;
        $form = ActiveForm::begin();

        echo $form->field($model,'title')->textInput();

        echo $form->field($model,'address')->textInput();

        echo $form->field($model,'actime')->textInput();

        echo $form->field($model,'exppeo')->textInput();

        echo $form->field($model,'tagcontent')->textInput(['placeholder' => '如有多个标签请用,号分割']);

        echo $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className());

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