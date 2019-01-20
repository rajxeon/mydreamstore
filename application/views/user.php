<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Mydreamstores</title>

	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	 crossorigin="anonymous"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+"
	 crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap-theme.min.css" integrity="sha384-jzngWsPS6op3fgRCDTESqrEJwRKck+CILhJVO5VvaAZCq8JYf8HsR/HPpBOOPZfR"
	 crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" integrity="sha384-vhJnz1OVIdLktyixHY4Uk3OHEwdQqPppqYR8+5mjsauETgLOcEynD9oPHhhz18Nw"
	 crossorigin="anonymous"></script>
	<style>
		:host {
			display: block;
			overflow: hidden;
		}

		:host([hidden]) {
			display: none;
		}
 
		:host {
			--twitter-user-link-color: #1c94e0;
			border-radius: 8px;
			border: 1px solid var(--twitter-user-link-color);
		}

		* {
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		}

		#container {

			background: #f1f1f1;
		}

		#content {
			padding: 24px 24px 20px 24px;
			position: relative;
		}

		#media {
			width: 100%;
			height: 144px;
			background-size: cover;
			background-repeat: no-repeat;
			background-position: 50% 50%;
		}

		#profile-image-container {
			position: absolute;
			top: -78px;
		}

		#profile-image {
			padding-right: 16px;
		}

		#profile-image img {
			border-radius: 50%;
			width: 144px;
			height: 144px;
			border: 6px solid #fff;
		}

		#name {
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
			padding-right: 4px;
			font-size: 18px;
			font-weight: bold;
			line-height: 24px;
		}

		#names {
			display: inline-flex;
			flex-direction: column;
		}

		#header {
			display: flex;
			justify-content: flex-start;
			margin-bottom: 24px;
		}

		#header-content {
			margin-left: 180px;
			width: 100%
		}

		#text {
			white-space: pre-line;
			margin-top: -16px;
			font-size: 27px;
			line-height: 32px;
			letter-spacing: .01em;
		}

		a {
			color: var(--twitter-user-link-color);
			text-decoration: none;
			outline: 0;
		}

		a:visited {
			color: var(--twitter-user-link-color);
			text-decoration: none;
			outline: 0;
		}

		#footer {
			display: flex;
			justify-content: space-between;
			margin-top: 24px;
		}

		#counts {
			display: flex;
			justify-content: space-between;
			margin-top: 16px;
		}

		.icon {
			width: 20px;
			height: 20px;
		}

		#names svg {
			width: 18px;
			height: 18px;
		}

		.center {
			text-align: center;
		}

		#footer svg {
			width: 14px;
			height: 14px;
			color: #657786;
		}

		#logo {
			float: right;
		}

		#logo svg {
			width: 42px;
			height: 42px;
		}

	</style>


	<script>

		$(document).ready(function(){
    getTweets('<?php echo $user->screen_name ?>')
})

function saveTweet(){
    status=$('textarea').val()
    $.post('<?php echo base_url("index.php/welcome/update") ?>',{'status':status},function(data){
        data=JSON.parse(data);
        console.log(data)
        $('#myModal').modal('hide');
        getTweets(data.user.screen_name)
    })
}

function getTweets(screen_name){
    //console.log(screen_name)

    $('#tweets').html('<img  src="https://www.drupal.org/files/issues/throbber_12.gif" style="height: 50px; display: block; margin: 80px auto;" />');

    $.get('<?php echo base_url("index.php/welcome/tweets") ?>'+"?screen_name="+screen_name,{},function(data){
        tweets=(JSON.parse(data))
        //console.log(tweets)
        html=''
        $(tweets).each(function(i,v){
            html+=`<div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-1">
                            <img style="border-radius: 100%; border: 2px solid #c6c6c6;" src="`+v.user.profile_image_url+`" />
                            </div>
                            <div class="col-lg-11">
                            <strong>`+v.user.name+`</strong><br>
                            `+v.text+`<br>
                            <small>`+v.created_at+`</small>
                            </div>
                        </div>
                        
                        
                    </div>
                    </div>  `
        })
        $('#tweets').html(html)
    })
}

function logout(){
    $.get('<?php echo base_url("index.php/welcome/disconnect") ?>',{},function(data){
        console.log(JSON.parse(data))
        window.location.replace("<?php echo base_url('index.php/welcome'); ?>");
    })
    
}
</script>

</head>

<body>

	<div id="container">

		<div id="media" style="background-color: rgb(192, 222, 237); background-image:url(<?php echo $user->profile_background_image_url ?>)"></div>
		<div id="content">

			<div id="header">
				<a id="profile-image-container" target="_blank" href="https://twitter.com/<?php echo $user->screen_name ?>">
					<span id="profile-image"><img src="<?php echo str_replace('AII47xlR_normal','AII47xlR_400x400',$user->profile_image_url) ?>"></span>
				</a>
				<div id="header-content">
					<div>
						<a target="_blank" href="https://twitter.com/<?php echo $user->screen_name ?>">
							<span id="names">
								<span id="name">
									<?php echo $user->name ?></span>
								<span>@
									<?php echo $user->screen_name ?>
									<!----></span>
							</span>
						</a>
						<button class="btn btn-primary btn-flat pull-right" onclick="getTweets('<?php echo $user->screen_name ?>')">Get
							Tweets</button>

						<button class="btn btn-info  pull-right" data-toggle="modal" data-target="#myModal" style="margin-right: 10px;">
							Tweet
                        </button>
                        
                        <button style="margin-right: 10px;" class="btn btn-danger btn-flat pull-right" onclick="logout()"> Logout</button>

						<span id="logo"><a target="_blank" href="https://twitter.com/<?php echo $user->screen_name ?>">
								<!----><svg id="Logo_FIXED" data-name="Logo — FIXED" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400">
									<defs>
										<style>
											.cls-1 {
												fill: none;
											}

											.cls-2 {
												fill: #1da1f2;
											}

										</style>
									</defs>
									<title>Twitter_Logo_Blue</title>
									<rect class="cls-1" width="400" height="400"></rect>
									<path class="cls-2" d="M153.62,301.59c94.34,0,145.94-78.16,145.94-145.94,0-2.22,0-4.43-.15-6.63A104.36,104.36,0,0,0,325,122.47a102.38,102.38,0,0,1-29.46,8.07,51.47,51.47,0,0,0,22.55-28.37,102.79,102.79,0,0,1-32.57,12.45,51.34,51.34,0,0,0-87.41,46.78A145.62,145.62,0,0,1,92.4,107.81a51.33,51.33,0,0,0,15.88,68.47A50.91,50.91,0,0,1,85,169.86c0,.21,0,.43,0,.65a51.31,51.31,0,0,0,41.15,50.28,51.21,51.21,0,0,1-23.16.88,51.35,51.35,0,0,0,47.92,35.62,102.92,102.92,0,0,1-63.7,22A104.41,104.41,0,0,1,75,278.55a145.21,145.21,0,0,0,78.62,23"></path>
								</svg>
								<!----></a></span>
					</div>
				</div>
			</div>


			<div id="counts">
				<a target="_blank" href="https://twitter.com/<?php echo $user->screen_name ?>">
					<div>Tweets</div>
					<div class="center">
						<?php echo $user->statuses_count ?>
					</div>
				</a>
				<a target="_blank" href="https://twitter.com/<?php echo $user->screen_name ?>/following">
					<div>Following</div>
					<div class="center">
						<?php echo $user->friends_count ?>
					</div>
				</a>
				<a target="_blank" href="https://twitter.com/<?php echo $user->screen_name ?>/followers">
					<div>Followers</div>
					<div class="center">
						<?php echo $user->followers_count ?>
					</div>
				</a>
				<a target="_blank" href="https://twitter.com/<?php echo $user->screen_name ?>/likes">
					<div>Likes</div>
					<div class="center">
						<?php echo $user->favourites_count ?>
					</div>
				</a>
				<a target="_blank" href="https://twitter.com/<?php echo $user->screen_name ?>/lists">
					<div>Lists</div>
					<div class="center">
						<?php echo $user->listed_count ?>
					</div>
				</a>
			</div>



		</div>

	</div>
	<div id="tweets" class="container" style="    margin-top: 20px;">

	</div>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Tweet</h4>
				</div>
				<div class="modal-body">
					<textarea style="width: 100%; height: 120px;">Your tweet here</textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="saveTweet()">Save</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</body>

</html>
