local a,b=arg[1],arg[2];local expr=a.."*"..b;print(load("return "..expr)())
