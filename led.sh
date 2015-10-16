#!/bin/bash 
# Turn on a led connected to pin 24 of beagle board expansion header. 
# The led is on during 30 seconds 
# Read command line argument 

GPIO=$1 
# Open the GPIO port 
echo $GPIO > /sys/class/gpio/export 
# Turn on led for 30 seconds 
echo Turn on led 
echo "high" > /sys/class/gpio/gpio$GPIO/direction 
sleep 10 
echo Turn off led 
echo "low" > /sys/class/gpio/gpio$GPIO/direction  

# Release the GPIO port 
echo $GPIO > /sys/class/gpio/unexport
