#!/bin/bash

set -eo pipefail

sleeptime=59

# Since docker doesn't provide a lazy period for startup,
# we track health. If the last check showed healthy
# as determined by existence of /tmp/healthy, then
# sleep at startup. This requires the timeout to be set
# higher than the sleeptime used here.
if [ -f /tmp/healthy ]; then
    printf "container was previously healthy, so sleeping ${sleeptime} seconds before continuing healthcheck..."
    sleep ${sleeptime}
fi

prjstatus=false
resstatus=false

if ls /PROJECT/Documentation >/dev/null; then
    prjstatus=true
    printf "/PROJECT/Documentation: OK"
else
    printf "/PROJECT/Documentation access FAILED"
fi

if ls /RESULT >/dev/null; then
    resstatus=true
    printf "/RESULT: OK"
else
    printf "/RESULT access FAILED"
fi

# Check results
if ${prjstatus} = true -a ${resstatus} = true ; then
    touch /tmp/healthy
    exit 0
fi

rm -f /tmp/healthy
exit 1
