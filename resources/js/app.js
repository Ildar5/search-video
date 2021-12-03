require('./bootstrap');

window.Vue = require('vue').default;

new Vue({
    el: '#search',

    data: {
        video_list: '',
        q: ''
    },

    methods: {
        handleClick: function() {
            this.updateResult();
        },
        getVideoList() {
            axios.get('/get-video-list?q=' + this.q, {}).then(response => {
                if (response.data.status === 1) {
                    this.video_list = response.data.result;
                }
            });
        },
        changeUrlPushState() {
            let query = document.location.search;
            query = decodeURIComponent(query.replace(/\+/g, ' '));
            query = query.substr(1);
            query = this.parseJQueryParams(query);
            query.q = this.q;

            if (typeof query.q === "undefined") {
                query.q = '';
            }

            let search_url = location.pathname + '?q=' + query.q;
            window.history.pushState('video_list', 'Video List', search_url);
        },
        parseJQueryParams(p) {
            let params = {};
            let pairs = p.split('&');
            for (var i = 0; i < pairs.length; i++) {
                let pair = pairs[i].split('=');
                let indices = [];
                let name = decodeURIComponent(pair[0]),
                    value = decodeURIComponent(pair[1]);

                name = name.replace(/\[([^\]]*)\]/g,
                function (k, idx) {
                    indices[indices.length] = idx;
                    return "";
                });

                indices.unshift(name);
                let o = params;

                for (var j = 0; j < indices.length - 1; j++) {
                    let idx = indices[j];
                    let nextIdx = indices[j + 1];
                    if (!o[idx]) {
                        if ((nextIdx == "") || (/^[0-9]+$/.test(nextIdx)))
                            o[idx] = [];
                        else
                            o[idx] = {};
                    }
                    o = o[idx];
                }

                idx = indices[indices.length - 1];
                if (idx == "") {
                    o[idx] = value;
                }
                else {
                    o[idx] = value;
                }
            }
            return params;
        },
        getUrlSearchValue() {
            let url = new URL(window.location.href);
            let query = url.searchParams.get("q");
            if (query === null)
                return '';
            return query;
        },
        updateResult() {
            this.changeUrlPushState();
            if (this.q === '') {
                this.video_list = '';
            } else {
                this.getVideoList();
            }
        },
        addQuery() {
            this.q = this.getUrlSearchValue();
        }
    },

    created() {
        setTimeout(() => {
            this.addQuery();
            this.updateResult()
        }, 100)
    },
});