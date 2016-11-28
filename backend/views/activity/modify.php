<div class="result-wrap">
    <div class="result-content">
        <?php
        use yii\bootstrap\ActiveForm;
        use Yii;
        use yii\helpers\Html;
        $form = ActiveForm::begin();

        echo $form->field($model,'title')->textInput(['value' => $acInfo->title]);

        echo $form->field($model,'address')->textInput(['value' => $acInfo->address]);

        echo $form->field($model,'actime')->textInput(['value' => $acInfo->actime]);

        echo $form->field($model,'exppeo')->textInput(['value' => $acInfo->exppeo]);

        echo $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className())->textarea(['value' => $acInfo->content]);

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