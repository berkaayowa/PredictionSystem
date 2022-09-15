/**
 * Created by q on 18/09/30.
 */
self.addEventListener('message', function(e) {
    self.postMessage(e.data);
}, false);

