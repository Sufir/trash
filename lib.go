package extended

import (
	"fmt"
	"log"
)

type LogLevel int

const (
	LogLevelError LogLevel = iota
	LogLevelWarning
	LogLevelInfo
)

type LogExtended struct {
	*log.Logger
	logLevel LogLevel // LogLevel это enum
}

func NewLogExtended() *LogExtended {
	logger := new(LogExtended)
	logger.Logger = log.Default()
	return logger
}

func (this *LogExtended) println(srcLogLvl LogLevel, prefix, msg string) {
	// игнорируем сообщения, если уровень логгера меньше scrLogLvl
	if this.logLevel < srcLogLvl {
		this.Logger.Println(prefix + " " + msg)
	}
}

func (this *LogExtended) SetLogLevel(logLvl LogLevel) {
	if (logLvl != LogLevelError && logLvl != LogLevelWarning && logLvl != LogLevelInfo) {
		panic(fmt.Sprintf("Unknown log level: %d", logLvl))
	}

	this.logLevel = logLvl
}

func (this *LogExtended) Infoln(msg string) {
	this.println(LogLevelInfo, "INFO:", msg)
}

func (this *LogExtended) Warnln(msg string) {
	this.println(LogLevelWarning, "WARN:", msg)
}

func (this *LogExtended) Errorln(msg string) {
	this.println(LogLevelWarning, "ERR:", msg)
}
