# PHP Code Sample

This sample is constructed using Visual Studio Code 1.38.1, so the editor is required if you want to run the application out of the box. You may also use another IDE of your choice, but some code structure may need some modification or conversion.

__Note: This sample is constructed with PHP 7.2.18__

## Running sample in VSC

PHP usually hosted in a local / remote server, and accessed using web browser as a web application. Unlike that, this project is using local PHP interpreter to view the output on local console on VSC without using any local or remote server. It easier & minimizing configuration since this is only for development purpose.

Before starting, 
- Download as ZIP and extract
- In VSC, File > Open Folder
- Go inside <code>.vscode</code> folder and open <code>launch.json</code> file
- modify <code><b>runtimeExecutable</b></code> and point it to the PHP.exe located on your PC
- Save the file

To run the sample after doing all above:
- Make sure to change the required information in <code>app.php</code> file
- Go to Debug (bug icon on the left pane or hit <code>Ctrl + Shift + D</code>)
- Click Play icon (Start Debugging)
- Output should be displayed on "Debug Console"

..or you can just go to Debug > Start Debugging, or just press F5 if it's available
