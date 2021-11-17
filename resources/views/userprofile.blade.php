@extends('header')

@section('comment')

@stop

@section('content')

<!--==================================
=            User Profile            =
===================================-->
<section class="user-profile section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user">
						<!-- User Image -->
						<div class="image d-flex justify-content-center">
							<img src="images/user/{{ $users['image'] }}" alt="" class="">
						</div>
						<!-- User Name -->
						<h5 class="text-center">{{ $users['name'] }}</h5>
					</div>
					<!-- Dashboard Links -->
					<div class="widget dashboard-links">
						<ul>
							<li><a class="my-1 d-inline-block" href="">我的訂單</a></li>
						</ul>
						<form action="/logout" method="POST" style="text-align: center">
								<button type="submit" class="bg-info text-white border-0">登出</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-10 offset-md-1 col-lg-9 offset-lg-0">
				<!-- Edit Profile Welcome Text -->
				<div class="widget welcome-message">
					<h2>編輯個人資料</h2>
				</div>
				<!-- Edit Personal Info -->
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="widget personal-info">
							<h3 class="widget-header user">個人資訊</h3>
							<form action="/edit" method="POST" enctype="multipart/form-data">
							@csrf
								<!-- Username -->
								<div class="form-group">
									<label for="username">帳號</label>
									<input disabled="disabled" type="text" class="form-control" name="username" placeholder="{{ $users['username'] }}">
								</div>
								<!-- Name -->
								<div class="form-group">
									<label for="name">姓名</label>
									<input type="text" class="form-control" name="name" placeholder="{{ $users['name'] }}">
								</div>
								<!-- File chooser -->
								<div class="form-group choose-file d-inline-flex">
									<i class="fa fa-user text-center px-3"></i>
									<input type="file" name="image" class="form-control-file mt-2 pt-1">
								 </div>
								<!-- Submit button -->
								<button type="submit" class="btn btn-transparent">保存變更</button>
							</form>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<!-- Change Password -->
					<div class="widget change-password">
						<h3 class="widget-header user">修改密碼</h3>
						<form action="/changePwd" method="POST" enctype="multipart/form-data">
							<!-- Current Password -->
							<div class="form-group">
								<label for="current-password">舊密碼</label>
								<input type="password" name="old_pwd" pattern=".{6,}" class="form-control" id="current-password" required>
							</div>
							<!-- New Password -->
							<div class="form-group">
								<label for="new-password">新密碼</label>
								<input type="password" name="password" pattern=".{6,}" class="form-control" id="new-password" required>
							</div>
							<!-- Confirm New Password -->
							<div class="form-group">
								<label for="confirm-password">再輸入一次新密碼</label>
								<input type="password" name="pwd_confirm" pattern=".{6,}" class="form-control" id="confirm-password" required>
							</div>
							@foreach ($errors->all() as $error)
                                <p style="color:red">{{ $error }}</p>
                            @endforeach
							<!-- Submit Button -->
							<button class="btn btn-transparent">更改密碼</button>
						</form>
					</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<!-- Change about me -->
					<div class="widget change-email mb-0">
						<h3 class="widget-header user">關於我</h3>
						<form action="/editInformation" method="POST">
							<!-- Current sex -->
							<div class="form-group">
								<label for="sex">性別</label><br>
									<input type="radio" name="sex" value="1" {{ ($users['sex'] == 1)? "checked" : "" }}>
								<label for="boy">男</label>
									<input type="radio" name="sex" value="0" {{ ($users['sex'] == 0)? "checked" : "" }}>
								<label for="girl">女</label><br>
							</div>
							<!-- birthday -->
							<div class="form-group">
								<label for="birthday">生日</label>
								<input type="date" name="birthday" class="form-control" value="{{ $users['birthday'] }}">
							</div>
							<!-- phone -->
							<div class="form-group">
								<label for="phone">電話</label>
								<input type="phone" name="phone" class="form-control" placeholder="電話" value="{{ $users['phone'] }}">
							</div>
							<!-- address -->
							<div class="form-group">
								<label for="address">地址</label>
								<div id="twzipcode" class="form-row">
                                    <div class="form-group col">
                                        <div data-role="county" data-style="form-control" data-name="county" data-value="{{ $users['county'] }}"></div>
                                    </div>
                                    <div class="form-group col">
                                        <div data-role="district" data-style="form-control" data-name="district" data-value="{{ $users['district'] }}"></div>
                                    </div>
                                    <div class="form-group col">
                                        <div data-role="zipcode" data-style="form-control" data-name="zipcode" data-value=""></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputAddress2" name="address" placeholder="地址" value="{{ $users['address'] }}">
                                </div>
							</div>
							<!-- Submit Button -->
							<button type="submit" class="btn btn-transparent">確認修改</button>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/jquery-twzipcode@1.7.14/jquery.twzipcode.min.js"></script>
<script>
  $("#twzipcode").twzipcode({});
</script>
@stop