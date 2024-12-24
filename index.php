<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RecommPhone</title>
	<style>
		@font-face {
      font-family: "Roboto";
      src: local("Roboto Thin"), url("../fonts/roboto/Roboto-Thin.woff2") format("woff2"), url("../fonts/roboto/Roboto-Thin.woff") format("woff");
      font-weight: 100;
    }

    @font-face {
      font-family: "Roboto";
      src: local("Roboto Light"), url("../fonts/roboto/Roboto-Light.woff2") format("woff2"), url("../fonts/roboto/Roboto-Light.woff") format("woff");
      font-weight: 300;
    }

    @font-face {
      font-family: "Roboto";
      src: local("Roboto Regular"), url("../fonts/roboto/Roboto-Regular.woff2") format("woff2"), url("../fonts/roboto/Roboto-Regular.woff") format("woff");
      font-weight: 400;
    }

    @font-face {
      font-family: "Roboto";
      src: local("Roboto Medium"), url("../fonts/roboto/Roboto-Medium.woff2") format("woff2"), url("../fonts/roboto/Roboto-Medium.woff") format("woff");
      font-weight: 500;
    }

    @font-face {
      font-family: "Roboto";
      src: local("Roboto Bold"), url("../fonts/roboto/Roboto-Bold.woff2") format("woff2"), url("../fonts/roboto/Roboto-Bold.woff") format("woff");
      font-weight: 700;
    }

		body {
			font-family: "Roboto", sans-serif;
		}

		header {
			box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);

		}

		.main-content {
			padding: 100px;
			margin-top: 150px;
			height: 100%;
		}

		.find {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}

		.butt {
			padding: 12px;
			background-color: rgb(31, 30, 30);
			color:rgb(41, 41, 41);
			border-radius: 0.75em;
			font-weight: 700;
			margin-top: 20px;
		}

		.butt a {
			text-decoration: none; /* Menghilangkan underline */
			color: white; /* Membuat teks menjadi putih */
		}

		.loader {
			position: relative;
			display: flex;
			align-items: center;
			justify-content: center;
			width: 100%;
			max-width: 6rem;
			margin-top: 3rem;
			margin-bottom: 3rem;
		}
		.loader:before,
		.loader:after {
			content: "";
			position: absolute;
			border-radius: 50%;
			animation: pulsOut 1.8s ease-in-out infinite;
			filter: drop-shadow(0 0 1rem rgba(24, 23, 23, 0.75));
		}
		.loader:before {
			width: 100%;
			padding-bottom: 100%;
			box-shadow: inset 0 0 0 1rem #000000;
			animation-name: pulsIn;
		}
		.loader:after {
			width: calc(100% - 2rem);
			padding-bottom: calc(100% - 2rem);
			box-shadow: 0 0 0 0 #000000;
		}

		@keyframes pulsIn {
			0% {
				box-shadow: inset 0 0 0 1rem #000000;
				opacity: 1;
			}
			50%, 100% {
				box-shadow: inset 0 0 0 0 #000000;
				opacity: 0;
			}
		}

		@keyframes pulsOut {
			0%, 50% {
				box-shadow: 0 0 0 0 #000000;
				opacity: 0;
			}
			100% {
				box-shadow: 0 0 0 1rem #000000;
				opacity: 1;
			}
		}
		
	</style>
</head>
<body>
	<header>
		<nav style="display: flex; justify-content: center; items-align: center;">
			<h1>RecommPhone</h1>
		</nav>
	</header>

	<main class="main-content">
		<div class="find">
			<h1>Welcome to RecommPhone</h1>
			<p>Get Started Now and Find Your Perfect Match!</p>
			<span class="loader" style="padding: 4px;"></span>
			<button class="butt"><a href="rekomendasi.php">GET STARTED</a></button>
		</div>
	</main>
</body>
</html>