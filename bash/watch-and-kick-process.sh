#!/bin/bash
PID=`pidof node`
if [ $PID > 0 ]; then
  echo "node still running"
else
  echo "node died"
  curl -d "Msg=node died&_s=yourErrorStackKeyGoesHere&_r=json" http://www.errorstack.com/submit
  # command to start node server again goes here
fi