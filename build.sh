#!/bin/bash

BUILDROOT_VERSION=2022.02.2
BUILDROOT_ARCHIVE_TYPE=xz

# apt install bc ncurses-dev

if [ ! -d "build" ]
then
    mkdir build
fi

cd build || exit

if [ ! -f "buildroot-$BUILDROOT_VERSION.tar.$BUILDROOT_ARCHIVE_TYPE" ]
then
  wget https://buildroot.org/downloads/buildroot-$BUILDROOT_VERSION.tar.$BUILDROOT_ARCHIVE_TYPE
fi

if [ ! -d "buildroot-$BUILDROOT_VERSION" ]
then
    tar xf buildroot-$BUILDROOT_VERSION.tar.$BUILDROOT_ARCHIVE_TYPE
fi

cp ../configs/buildroot/.config buildroot-$BUILDROOT_VERSION/

cd buildroot-$BUILDROOT_VERSION || exit

# make nconfig

make -j8
