<!-- ▼ログイン -->
                                            
		<div class="block_outer">
		    <div id="login_area">
		        <h2>Login</h2>
        		<form name="login_form" id="login_form" method="post" action="http://test.hyperion-job.jp/frontparts/login_check.php" onsubmit="return fnCheckLogin('login_form')">
					<input type="hidden" name="transactionid" value="98038189d2b2a77be994d3d1d5a1d5689a60de32" />
					<input type="hidden" name="mode" value="login" />
					<input type="hidden" name="url" value="/" />
						<div class="top_login">
						<dl class="formlist">
							<dt>メールアドレス</dt>
							<dd>
                                <input type="text" name="login_email" value="" class="box300" id="a" aria-required="true" aria-invalid="false" placeholder="MailAddress" style="ime-mode: disabled;" />
              	          </dd>
							<dt class="password">パスワード <a href="https://test.hyperion-job.jp/forgot/" onclick="win01('https://test.hyperion-job.jp/forgot/','forget','600','400'); return false;" target="_blank">【？】</a></dt>
							<dd><input type="password" name="login_pass" value="" class="box300" id="a" aria-required="true" aria-invalid="false" placeholder="Password" style="ime-mode: disabled;"  /></dd>
						</dl>
                            <div class="top_login_btn">
                                    <input type="checkbox" name="login_memory" checked="checked" value="1" id="login_memory"><label for="login_memory">ログインを保存する</label>

                                                                <!-- <input type="checkbox" name="login_memory" checked="checked" id="login_memory" /><label for="login_memory">ログインを保存する</label>
           <input type="checkbox" name="login_memory" id="login_memory" value="1" /><label for="login_memory">memory</label> -->
                                    <!-- <input type="checkbox" name="login_memory" id="login_memory" value="1"  /><label for="login_memory"></label> -->
                                <p><input type="image" onmouseover="chgImgImageSubmit('/user_data/packages/default/img/button/btn_bloc_login_on.jpg',this)" onmouseout="chgImgImageSubmit('/user_data/packages/default/img/button/btn_bloc_login.jpg',this)" src="/user_data/packages/default/img/button/btn_bloc_login.jpg" alt="ログイン" />
						</p>
                            </div>
                            </div>
						</div>
     			   </form>
  			  </div>

<!-- ▲ログイン -->
