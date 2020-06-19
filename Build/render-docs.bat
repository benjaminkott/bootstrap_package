@echo off

pushd %~dp0
docker-compose --file render-docs.yml run --rm t3docmake
popd

echo Rendering has done, find the results in .build/Documentation
