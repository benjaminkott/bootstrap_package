#!/bin/bash

# Clean up or create project folder
if [ -d /PROJECT ]; then
    rm -rf /PROJECT/*
else
    mkdir -p /PROJECT
fi

# Link doc folder
ln -sf /mnt/t3rd-project/Documentation /PROJECT/Documentation
#mv build/src/doc/doc build/src/doc/Documentation

# Clean up temp folder
rm -rf /tmp/*

# Keep container alive
sleep infinity
