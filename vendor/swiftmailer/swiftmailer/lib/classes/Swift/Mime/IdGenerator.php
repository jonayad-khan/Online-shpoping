nValue(false));

        $process->expects($this->never())
            ->method('getOutput');

        $process->expects($this->never())
            ->method('getErrorOutput');

        $process->expects($this->once())
            ->method('getExitCode')
            ->will($this->returnValue($exitCode));

        $process->expects($this->once())
            ->method('getExitCodeText')
            ->will($this->returnValue($exitText));

        $process->expects($this->once())
            ->method('isOutputDisabled')
            ->will($this->returnValue(true));

        $process->expects($this->once())
            ->method('getWorkingDirectory')
            ->will($this->returnValue($workingDirectory));

        $exception = new ProcessFailedException($process);

        $this->assertEquals(
            "The command \"$cmd\" failed.\n\nExit Code: $exitCode($exitText)\n\nWorking directory: {$workingDirectory}",
            $exception->getMessage()
        );
    }
}
                                                                 