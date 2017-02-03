var attachmentAnalytics = {
	trackView:function(url) {
		if (typeof ga === "function") {
			ga("send", "pageview", url);
		}
	}
}