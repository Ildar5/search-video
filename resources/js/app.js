require('./bootstrap');

window.Vue = require('vue').default;

new Vue({
    el: '#search',

    data: {},

    computed: {},

    methods: {
        handleClick: function(item) {
            let query = document.getElementById('q').value;
            this.changeUrlPushState('q', query);

            axios.get('/get-video-list?q=' + query, {}).then(response => {
                if (response.data.status === 1) {
                    let element = document.getElementById('search-result');
                    element.innerHTML = element.innerHTML.replace(element.innerHTML, response.data.result);
                }
            });
        },
        changeUrlPushState(param, value) {
            let query = document.location.search;
            query = decodeURIComponent(query.replace(/\+/g, ' '));
            query = query.substr(1);
            query = this.parseJQueryParams(query);

            query.q = value;

            if (typeof query.q === "undefined") {
                query.q = '';
            }

            console.log(query);
            console.log(location.pathname);
            let search_url = location.pathname + '?q=' + query.q;
            console.log(search_url);
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
                    console.log('k, idx');
                    console.log(k);
                    console.log(idx);
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
    }
});