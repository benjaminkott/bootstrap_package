#!/bin/bash

pushd `dirname "$0"` >/dev/null
docker-compose --file render-docs.yml run --rm t3docmake
popd >/dev/null

echo "Rendering has done, find the results in .build/Documentation"
