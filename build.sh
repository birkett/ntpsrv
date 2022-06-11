#!/bin/bash

source versions.sh

# apt install bc ncurses-dev libssl-dev

if [ ! -d "build" ]
then
    mkdir build
fi

cd build || exit

if [ ! -f "buildroot-$BUILDROOT_VERSION.tar.$BUILDROOT_ARCHIVE_TYPE" ]
then
  wget https://buildroot.org/downloads/buildroot-"$BUILDROOT_VERSION".tar."$BUILDROOT_ARCHIVE_TYPE"
fi

if [ ! -d "buildroot-$BUILDROOT_VERSION" ]
then
    tar xf buildroot-"$BUILDROOT_VERSION".tar."$BUILDROOT_ARCHIVE_TYPE"
fi

cp ../configs/buildroot/.config buildroot-"$BUILDROOT_VERSION"/

cd buildroot-"$BUILDROOT_VERSION" || exit

# make nconfig

make -j8

cd output/images || exit

if [ -d "boot" ]
then
    rm -rf boot
fi

mkdir boot

cd boot || exit

sudo cp ../../../../../boot/* .
sudo cp ../zImage kernel.img
sudo cp ../../build/linux-"$LINUX_GIT_HASH"/arch/arm/boot/dts/"$TARGET_DTB" .
sudo cp ../../build/rpi-firmware-*/boot/bootcode.bin .
sudo cp ../../build/rpi-firmware-*/boot/fixup_cd.dat .
sudo cp ../../build/rpi-firmware-*/boot/start_cd.elf .

tar -cf ../bootfs.tar .

dd if=/dev/zero of=../bootfs.vfat bs=16M count=1
sudo mkfs.vfat ../bootfs.vfat

../../host/bin/mcopy -i ../bootfs.vfat * ::


cp ../rootfs.ext2 ../../../../
cp ../bootfs.vfat ../../../../
