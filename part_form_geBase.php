<form action="submitGeBase.php" method="POST" class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label for="geCode" class="col-6 col-lg-6 control-label">GE编号:</label>
                                <div class="col-lg-6 col-6">
                                    <input type="text" class="form-control" id="geCode" name="geCode" value="<?php echo $geCode ?>" placeholder="<?php echo $geCode ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-6 col-lg-6 control-label">名称:</label>
                                <div class="col-lg-6 col-6">
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" placeholder="<?php echo $name ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_CN" class="col-6 col-lg-6 control-label">中文名:</label>
                                <div class="col-lg-6 col-6">
                                    <input type="text" class="form-control" id="name_CN" name="name_CN" value="<?php echo $name_CN ?>" placeholder="<?php echo $name_CN ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lang" class="col-6 col-lg-6 control-label">教学语言:</label>
                                <div class="col-lg-6 col-6">
                                    <select id="lang" class="form-control" name="lang">
                                        <option value="en">英语</option>
                                        <option value="CH">中文</option>
                                        <option value="BO">混讲</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quiz" class="col-6 col-lg-6 control-label">quiz数量:</label>
                                <div class="col-lg-6 col-6">
                                    <select id="quiz" class="form-control" name="quiz">
                                        <option value="0">没有</option>
                                        <option value="1">1个</option>
                                        <option value="2">2个</option>
                                        <option value="3">3个</option>
                                        <option value="4">4个</option>
                                        <option value="5">5个</option>
                                        <option value="6">6个及以上</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="finalExam" class="col-6 col-lg-6 control-label">期末考试:</label>
                                <div class="col-lg-6 col-6">
                                    <select id="finalExam" class="form-control" name="finalExam">
                                        <option value="0">没有</option>
                                        <option value="1">有</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="presentation" class="col-6 col-lg-6 control-label">presentation:</label>
                                <div class="col-lg-6 col-6">
                                    <select id="presentation" class="form-control" name="presentation">
                                        <option value="0">没有</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="report" class="col-6 col-lg-6 control-label">report:</label>
                                <div class="col-lg-6 col-6">
                                    <select id="report" class="form-control" name="report">
                                        <option value="0">没有</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="groupMember" class="col-6 col-lg-6 control-label">小组成员:</label>
                                <div class="col-lg-6 col-6">
                                    <select id="groupMember" class="form-control" name="groupMember">
                                        <option value="1">不分组</option>
                                        <option value="2-3">2-3人</option>
                                        <option value="4-5">4-5人</option>
                                        <option value="6-－">6人以上</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-4 col-lg-4 control-label">Email</label>
                                <div class="input-group col-lg-8 col-8">
                                    <input type="text" class="form-control" id="email" name="email" required>
                                    <span class="input-group-addon">-c@my.cityu.edu.hk</span>
                                </div>
                                <div class="col-lg-offset-2 col-lg-10">
                                    <small>为了保证基础数据的可靠性，提交需要进行身份验证，提交后会有验证码发送到以"@my.cityu.edu.hk"的邮箱中，请注意查收。</small>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-default" value="提交">
                        </fieldset>
                    </form>