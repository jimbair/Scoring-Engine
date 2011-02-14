#!/usr/bin/python
# Module to check if an SSH server is online and listening.
# Verifies if the username/password provided works.
 
import paramiko
import sys

from optparse import OptionParser

def checkSSH(hostname, port, username, password, timeout):
    """
    Check if SSH is online and works with provided 
    username and password
    """
    ssh = paramiko.SSHClient()
    ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    try:
        ssh.connect(hostname, port=port, username=username,
                    password=password, timeout=timeout)
        return True
    except:
        return False

def main():
    """
    Main function for ssh.py
    """

    # Our defaults. For our uses, we only really
    # need to change the hostname. But in case we want
    # to change things on the fly, we can.
    timeout = 3
    port = 22
    username = 'legituser'
    password = 'legitp4ssw0rd'

    # Build our options to parse
    parser = OptionParser()
    
    parser.add_option('-u', '--username',
                      action='store', type='string',
                      help="Username", metavar='username')

    parser.add_option('-p', '--password',
                      action='store', type='string',
                      help="Password", metavar='p4ssw0rD')

    parser.add_option('-P', '--port',
                      action='store', type='int',
                      help="SSH Port", metavar='22')

    parser.add_option('-t', '--timeout',
                      action='store', type='int',
                      help="SSH Timeout", metavar='3')

    parser.add_option('-H', '--hostname',
                      action='store', type='string',
                      help="SSH Server", metavar='server.com')

    # Build our options
    (options, args) = parser.parse_args()

    # If we have a new value, overwrite the defaults
    if options.username is not None:
        username = options.username
    if options.password is not None:
        password = options.password
    if options.port is not None:
        port = options.port
    if options.timeout is not None:
        timeout = options.timeout

    # This should not have a default value
    if options.hostname is not None:
        hostname = options.hostname
    else:
        msg = 'Error: You must provide a hostname.\n'
        msg += '       Use --help for more information.\n'
        sys.stderr.write(msg)
        sys.exit(1)

    # Connect to the SSH server
    result = checkSSH(hostname=hostname, port=port, username=username,
                      password=password, timeout=timeout)

    # Return our result for the master process to update the db    
    if result:
        sys.stdout.write('SUCCESS\n')
    else:
        sys.stdout.write('FAILURE\n')

    # All done
    sys.exit(0)

# Do the deed
if __name__ == '__main__':
    main()
