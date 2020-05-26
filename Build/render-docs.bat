@echo off

pushd %~dp0
docker-compose --file render-docs.yml run --rm t3docmake
popd
