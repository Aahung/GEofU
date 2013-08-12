<form action="submitComment.php" method="POST" class="form-horizontal" onsubmit="return ensure()">
                    <fieldset>
                        <div class="form-group">
                            <label for="geCode" class="col-6 col-lg-6 control-label">GE编号:</label>
                            <div class="col-lg-6 col-6">
                                <input type="text" class="form-control" id="geCode" name="geCode" placeholder="GE????">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="overallRange" class="col-6 col-lg-6 control-label">总体评价:</label>
                            <div class="col-lg-6 col-6">
                                <input type="range" class="form-control" id="overallRange" onChange="showRange(this.id)"><input style="width:60px" type="number" name="overallRange" value="50" id="overallRangeDisplay">分
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gradeRange" class="col-6 col-lg-6 control-label">所得成绩:</label>
                            <div class="col-lg-6 col-6">
                                <select id="gradeRange" name="gradeRange">
                                    <option value="4.3">A+</option>
                                    <option value="4.0">A</option>
                                    <option value="3.7">A-</option>
                                    <option value="3.3">B+</option>
                                    <option value="3.0">B</option>
                                    <option value="2.7">B-</option>
                                    <option value="2.3">C+</option>
                                    <option value="2.0">C</option>
                                    <option value="1.7">C-</option>
                                    <option value="1.3">D+</option>
                                    <option value="1.0">D</option>
                                    <option value="0.7">D-</option>
                                    <option value="0.0">F</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gradeSatisfaction" class="col-6 col-lg-6 control-label">成绩满意:</label>
                            <div class="col-lg-6 col-6">
                                <input type="range" class="form-control" id="gradeSatisfaction" onChange="showRange(this.id)"><input style="width:60px" type="number" value="50" name="gradeSatisfaction" id="gradeSatisfactionDisplay">分
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="difficulty" class="col-6 col-lg-6 control-label">课程难度:</label>
                            <div class="col-lg-6 col-6">
                                <input type="range" class="form-control" id="difficulty" onChange="showRange(this.id)"><input style="width:60px" type="number" value="50" name="difficulty" id="difficultyDisplay">分
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="loads" class="col-6 col-lg-6 control-label">课程负担:</label>
                            <div class="col-lg-6 col-6">
                                <input type="range" class="form-control" id="loads" onChange="showRange(this.id)"><input style="width:60px" type="number" name="loads" value="50" id="loadsDisplay">分
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="value" class="col-6 col-lg-6 control-label">课程价值:</label>
                            <div class="col-lg-6 col-6">
                                <input type="range" class="form-control" id="value" onChange="showRange(this.id)"><input style="width:60px" type="number" name="value" value="50" id="valueDisplay">分
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-12">
                                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="我有话要说"></textarea>                                    
                            </div>
                        </div>
                        <input type="submit" class="btn btn-default" value="提交">
                    </fieldset>
                </form>