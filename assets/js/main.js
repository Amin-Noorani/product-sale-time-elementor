(function($) {
	$(document).ready(function() {
		const timer = (finaleDate, $this) => {
			const now = new Date().getTime();
			let diff = finaleDate - now;
			console.log(diff);
			if (diff < 0) {
				$this.closest('.offer-content').find('.end-sale-alert').show();
				$this.closest('.offer-content').find('.product-sale-timer').hide();
				return;
			}

			let days = Math.floor(diff / (1000 * 60 * 60 * 24));
			let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
			let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
			let seconds = Math.floor(diff % (1000 * 60) / 1000);

			days <= 99 ? days = `0${days}` : days;
			days <= 9 ? days = `00${days}` : days;
			hours <= 9 ? hours = `0${hours}` : hours;
			minutes <= 9 ? minutes = `0${minutes}` : minutes;
			seconds <= 9 ? seconds = `0${seconds}` : seconds;

			$('#days').text(days);
			$('#hours').text(hours);
			$('#minutes').text(minutes);
			$('#seconds').text(seconds);
		}

		$('.product-sale-timer').each(function() {
			var finaleDate = parseInt($(this).attr('data-final-date'))*1000;
			timer(finaleDate, $(this));
			setInterval(timer, 1000, finaleDate, $(this));
		})
	});
})(jQuery);