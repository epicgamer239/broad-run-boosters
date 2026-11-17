/**
 * Broad Run Athletic Boosters — front-end interactions
 */
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		initMobileNav();
		initAnnouncementBar();
		initGallery();
		initTeamDonate();
	});

	function initMobileNav() {
		var toggle = document.querySelector('.nav-toggle');
		var nav = document.getElementById('primary-navigation');

		if (!toggle || !nav) {
			return;
		}

		toggle.addEventListener('click', function () {
			var open = toggle.getAttribute('aria-expanded') === 'true';
			toggle.setAttribute('aria-expanded', open ? 'false' : 'true');
			nav.classList.toggle('is-open', !open);
		});

		nav.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', function () {
				toggle.setAttribute('aria-expanded', 'false');
				nav.classList.remove('is-open');
			});
		});

		document.addEventListener('keydown', function (event) {
			if (event.key === 'Escape' && nav.classList.contains('is-open')) {
				toggle.setAttribute('aria-expanded', 'false');
				nav.classList.remove('is-open');
				toggle.focus();
			}
		});
	}

	function initAnnouncementBar() {
		var bar = document.getElementById('announcement-bar');
		var closeBtn = bar ? bar.querySelector('.announcement-close') : null;
		var storageKey = 'brab_announcement_dismissed';

		if (!bar || !closeBtn) {
			return;
		}

		try {
			if (window.sessionStorage && sessionStorage.getItem(storageKey) === '1') {
				bar.classList.add('is-hidden');
				return;
			}
		} catch (e) {
			/* sessionStorage unavailable */
		}

		closeBtn.addEventListener('click', function () {
			bar.classList.add('is-hidden');
			try {
				if (window.sessionStorage) {
					sessionStorage.setItem(storageKey, '1');
				}
			} catch (e) {
				/* ignore */
			}
		});
	}

	function initGallery() {
		var track = document.getElementById('gallery-track');
		var prev = document.querySelector('.gallery-prev');
		var next = document.querySelector('.gallery-next');

		if (!track || !prev || !next) {
			return;
		}

		function scrollByAmount(direction) {
			var amount = Math.max(track.clientWidth * 0.7, 240);
			track.scrollBy({
				left: direction * amount,
				behavior: 'smooth'
			});
		}

		prev.addEventListener('click', function () {
			scrollByAmount(-1);
		});

		next.addEventListener('click', function () {
			scrollByAmount(1);
		});
	}

	function initTeamDonate() {
		document.querySelectorAll('.team-donate').forEach(function (form) {
			var select = form.querySelector('.team-donate-select');
			var hint = form.querySelector('.team-donate-hint');
			if (!select) {
				return;
			}

			function update() {
				var option = select.options[select.selectedIndex];
				var dedicated = option && option.getAttribute('data-dedicated') === '1';
				if (hint) {
					hint.hidden = dedicated;
				}
			}

			select.addEventListener('change', update);
			update();

			form.addEventListener('submit', function (event) {
				event.preventDefault();
				window.open(select.value, '_blank', 'noopener');
			});
		});
	}
})();
