<?php declare(strict_types=1);

Class SportUtilities {
	public static function getHeaderPage(User $user) : string {
		$idImage = $user->getIdImage();
		return <<<HTML
<div class="d-flex flex-row flex-grow-1 mb-4 p-2 w-100 main-bar sticky-top">
	<a href="#" class="header-title link">
		<h4 class="header-title">
			GAKALL <span class="header-span">Sport</span>
		</h4>
	</a>
	<input name="name" placeholder="Search" type="text" id="header-searchbar" class="searchbar" />
	<svg width="30" height="30" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="header-svg-search">
		<path d="M12.5 11H11.71L11.43 10.73C12.41 9.59 13 8.11 13 6.5C13 2.91 10.09 0 6.5 0C2.91 0 0 2.91 0 6.5C0 10.09 2.91 13 6.5 13C8.11 13 9.59 12.41 10.73 11.43L11 11.71V12.5L16 17.49L17.49 16L12.5 11V11ZM6.5 11C4.01 11 2 8.99 2 6.5C2 4.01 4.01 2 6.5 2C8.99 2 11 4.01 11 6.5C11 8.99 8.99 11 6.5 11Z" fill="black" />
	</svg>
	<svg width="42" height="24" viewBox="0 0 42 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="header-svg-user">
		<path d="M14 9.5H8.75V4.25H5.25V9.5H0V13H5.25V18.25H8.75V13H14V9.5ZM31.5 11.25C34.405 11.25 36.7325 8.905 36.7325 6C36.7325 3.095 34.405 0.75 31.5 0.75C30.94 0.75 30.3975 0.8375 29.9075 0.995C30.905 2.4125 31.4825 4.1275 31.4825 6C31.4825 7.8725 30.8875 9.57 29.9075 11.005C30.3975 11.1625 30.94 11.25 31.5 11.25ZM22.75 11.25C25.655 11.25 27.9825 8.905 27.9825 6C27.9825 3.095 25.655 0.75 22.75 0.75C19.845 0.75 17.5 3.095 17.5 6C17.5 8.905 19.845 11.25 22.75 11.25ZM34.335 15.03C35.7875 16.3075 36.75 17.935 36.75 20V23.5H42V20C42 17.305 37.8525 15.6425 34.335 15.03ZM22.75 14.75C19.25 14.75 12.25 16.5 12.25 20V23.5H33.25V20C33.25 16.5 26.25 14.75 22.75 14.75Z" fill="black" />
	</svg>
	<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="header-svg-messages">
		<g filter="url(#filter0_d)">
			<rect x="4" y="5" width="32" height="31" fill="url(#pattern0)" shape-rendering="crispEdges" />
		</g>
		<rect x="29" y="29" width="15" height="15" fill="url(#pattern1)" />
		<circle cx="33" cy="7" r="7" fill="#FF6B00" fill-opacity="0.66" />
		<path d="M34.9531 10H31.2266V9.48047L33.1953 7.29297C33.487 6.96224 33.6875 6.69401 33.7969 6.48828C33.9089 6.27995 33.9648 6.0651 33.9648 5.84375C33.9648 5.54688 33.875 5.30339 33.6953 5.11328C33.5156 4.92318 33.276 4.82812 32.9766 4.82812C32.6172 4.82812 32.3372 4.93099 32.1367 5.13672C31.9388 5.33984 31.8398 5.6237 31.8398 5.98828H31.1172C31.1172 5.46484 31.2852 5.04167 31.6211 4.71875C31.9596 4.39583 32.4115 4.23438 32.9766 4.23438C33.5052 4.23438 33.9232 4.3737 34.2305 4.65234C34.5378 4.92839 34.6914 5.29688 34.6914 5.75781C34.6914 6.31771 34.3346 6.98438 33.6211 7.75781L32.0977 9.41016H34.9531V10Z" fill="white" />
		<defs>
			<filter id="filter0_d" x="0" y="5" width="40" height="39" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
				<feFlood flood-opacity="0" result="BackgroundImageFix" />
				<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
				<feOffset dy="4" />
				<feGaussianBlur stdDeviation="2" />
				<feComposite in2="hardAlpha" operator="out" />
				<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
				<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
				<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
			</filter>
			<pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
				<use xlink:href="#image0" transform="translate(0.015625) scale(0.0322917 0.0333333)" />
			</pattern>
			<pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1" height="1">
				<use xlink:href="#image1" transform="scale(0.0333333)" />
			</pattern>
			<image id="image0" width="30" height="30" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAAxElEQVRIie3WMWpCURBG4Q8FSRrtbC2SPhvICmzchVuwtXQLbsE2pVUIkjqQHVgqNmIj6EvxGHhFQAIvcxt/OPVhhrlzh3sKZ4MvTLLFVYNPvJYQB294LiGucMYSw2xxcMQcj9niYIsputni4BvjEuJgjZcS4goXrDDKFgcnLDDIFgd7zNDLFgfvTUHnL23ISJuV7iS3Ooarn1VxkeeUvkDSV2b6J3FQT+pDW8Jb4vRD4Kqe1Kf/Ev4mTj32PhQ6b+9pPT+XHgysHrPM6QAAAABJRU5ErkJggg==" />
			<image id="image1" width="30" height="30" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABVklEQVRIie3Uv04bQRDH8U9IhJCQKKiQ8ANYCrxDJNpQkQ6JAjroaPIKFJTpSKrQpQsVFS0lFKGCFjAPwB/x5ygYk/XZvjPm3Fj+SaPbm5md787e3jLSSMOsGRwhG5CdoJaHLsRzGocDgB5G7ZQF7vAtxpPYrxB6gKmovYibFJzhAavxPo4/FUD/YiJqLuM+/C3gDE/YDN9H/HwH9Dc+Ra0NPCaxNnDTtsL/Adt9QH9gLGp87xDvCu5lcjfrZdGF4Ay7yXat57Yrb/nP9KsgtxScYSfJW/H/gKR2H7GmdkpqloKvMK9VX3Gd5NxiKZdTx3m/4AbmIj7n5ddoXgJfcIbTGIvYHj4ncxpvBaed1nER/n+Y1a4ZHHeZ26nzjuB8p/lVX3q5aGphax1yGiWdt4G7ddqPFXXeAq4SWgZ/1SCgRfBXFX3TKix/blpUdadFnY800hDqGSg1f1dR0xmAAAAAAElFTkSuQmCC" />
		</defs>
	</svg>
	<div class="d-flex flex-column header-user-item">
		<img src="getImage.php?id=$idImage" class="header-img" alt="Avatar">
	</div>
</div>
HTML;
	}
}