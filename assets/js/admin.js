/**
 * Broad Run Boosters — admin media pickers (photos, galleries, documents).
 */
(function ($) {
	'use strict';

	$(document).on('click', '.brab-media-pick', function (event) {
		event.preventDefault();
		var $btn = $(this);
		var targetId = $btn.data('target');
		var type = $btn.data('type');
		var $input = $('#' + targetId);
		var $preview = $('#' + targetId + '_preview');

		var frame = wp.media({
			title: type === 'file' ? 'Choose a file' : (type === 'gallery' ? 'Choose photos' : 'Choose a photo'),
			button: { text: 'Use selected' },
			library: type === 'file' ? {} : { type: 'image' },
			multiple: type === 'gallery' ? 'add' : false
		});

		if (type === 'gallery') {
			frame.on('open', function () {
				var selection = frame.state().get('selection');
				String($input.val() || '').split(',').forEach(function (id) {
					id = parseInt(id, 10);
					if (id) {
						var attachment = wp.media.attachment(id);
						attachment.fetch();
						selection.add(attachment);
					}
				});
			});
		}

		frame.on('select', function () {
			var items = frame.state().get('selection').toJSON();
			if (type === 'file') {
				$input.val(items[0] ? items[0].url : '');
				return;
			}
			$input.val(items.map(function (item) { return item.id; }).join(','));
			$preview.empty();
			items.forEach(function (item) {
				var thumb = (item.sizes && item.sizes.thumbnail) ? item.sizes.thumbnail.url : item.url;
				$('<img>', { src: thumb, alt: '' }).css({ width: 90, height: 90, objectFit: 'cover', borderRadius: 4 }).appendTo($preview);
			});
		});

		frame.open();
	});

	$(document).on('click', '.brab-media-clear', function (event) {
		event.preventDefault();
		var targetId = $(this).data('target');
		$('#' + targetId).val('');
		$('#' + targetId + '_preview').empty();
	});
})(jQuery);
