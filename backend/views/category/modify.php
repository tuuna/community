<div class="result-wrap">
    <div class="result-content">
        <form action="__CONTROLLER__/edit" method="post" id="myform" name="myform" enctype="multipart/form-data">
            <table class="insert-tab" width="100%">
                <tbody>
                <tr>
                    <th><i class="require-red">*</i>学生学号：</th>
                    <td>
                        <input class="common-text required" id="title" name="stunum" size="50" value="{$scoreInfo[0]['stunum']}" type="text">
                        <input type="hidden" name="id" value="{$scoreInfo[0]['id']}" />
                    </td>
                </tr>

                <tr>
                    <th>科目：</th>
                    <td>
                        <input class="common-text" name="lessonname" size="50" value="{$scoreInfo[0]['lessonname']}" type="text">
                    </td>
                </tr>

                <tr>
                    <th>学期：</th>
                    <td>
                        <input class="common-text" name="term" size="50" value="{$scoreInfo[0]['term']}" type="text">
                    </td>
                </tr>

                <tr>
                    <th>学分：</th>
                    <td>
                        <input class="common-text" name="lessonscore" size="50" value="{$scoreInfo[0]['lessonscore']}" type="text">
                    </td>
                </tr>

                <tr>
                    <th>等级：</th>
                    <td>
                        <input class="common-text" name="level" size="50" value="{$scoreInfo[0]['level']}" type="text">
                    </td>
                </tr>

                <tr>
                    <th>分数：</th>
                    <td>
                        <input class="common-text" name="finalscore" size="50" value="{$scoreInfo[0]['finalscore']}" type="text">
                    </td>
                </tr>


                <tr>
                    <th>
                        <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    </th>
                    <td>
                        <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                    </td>
                </tr>

                </tbody>
            </table>
        </form>
    </div>
</div>

</div>