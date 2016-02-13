; Universal Stream Kick
; 2010 by Steffen Schultz
; Feel free to modify

; Program name
$app = "Shoutcast Stream Kicker"

; Checks if program window exists
if WinExists($app) then 
winKill($app)
$killed = 1
else
$killed = 0
endIf

; Set title, use program name
autoItWinSetTitle($app)

; Get settings from ini file
$file = "config.ini"

; Check if file exists
if not fileExists($file) then 
msgBox(48,"Error","config.ini is missing.")
exit
endIf

; Get config values from file
$url = IniRead($file, "configuration", "url", "")

; Let's kick the stream
Local $hKick = InetGet($url, @TempDir & "\kick.tmp", 1, 1)
Do
    Sleep(250)
Until InetGetInfo($hKick, 2)    ; Check if the download is complete.
InetClose($hKick)   ; Close the handle to release resources.