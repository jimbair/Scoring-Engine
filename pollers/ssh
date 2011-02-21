#!/usr/bin/python
# Module to check if an SSH server is online and listening.
# Verifies if the username/password provided works.
#
# Required modules:
# paramiko
# 
# This module can be found on both yum and apt for most dists.
#
# Copyright (C) 2011 James Bair <james.d.bair@gmail.com>
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software Foundation,
# Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.

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
    # Still need to add specific exceptions here
    try:
        ssh.connect(hostname, port=port, username=username,
                    password=password, timeout=timeout)
        ssh.close()
        return True
    except:
        return False

def main():
    """
    Main function for ssh.py
    """

    # Build our options to parse
    usage = "usage: %prog [options] hostname"
    parser = OptionParser(usage)
    
    parser.add_option('-u', '--user', default='legituser',
                      action='store', type='string',
                      help="Username", metavar='user')

    parser.add_option('-p', '--password', default='legitp4ssw0rd',
                      action='store', type='string',
                      help="Password", metavar='pass')

    parser.add_option('-P', '--port', default=22,
                      action='store', type='int',
                      help="SSH Port", metavar=22)

    parser.add_option('-t', '--timeout', default=3,
                      action='store', type='int',
                      help="SSH Timeout", metavar='3')

    # Build our options
    (opt, arg) = parser.parse_args()

    # This should not have a default value
    if len(arg) != 1:
        msg = 'You must provide a hostname.'
        parser.error(msg) 

    # Connect to the SSH server
    result = checkSSH(hostname=arg[0], port=opt.port,
                      username=opt.user, password=opt.password,
                      timeout=opt.timeout)

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
