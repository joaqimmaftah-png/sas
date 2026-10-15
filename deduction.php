                        <form>                       
                            <input type="hidden" name="employee_id" id="employee_id">
                            <table>
                                <tr class="margin5">
                                    <td><p style=" margin-top: -5px;">Basic Salary</p></td>
                                    <td> 
                                        <div class="form-group">                                
                                            <input type="text" class="form-control" id="basic_salary" name="basic_salary" >
                                        </div>
                                    </td>

                                    <td><p style=" margin-top: -5px;padding-left: 4%;">Deduction</p></td>
                                    <td> 
                                        <div class="form-group">                                
                                            <input type="text" class="form-control" id="dearness" name="dearness" >
                                        </div>
                                    </td>

                                </tr>
                                                            
                            </table>
                            <div class="form-group">
                                <label for="comment">Reason(s):</label>
                                <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                  </div>
                            <input type="button" class="button primary" value ="Save" onclick="PostData()" />
                           

                        </form>