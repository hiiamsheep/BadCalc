// public class Dispatch{public static void main(String[]a)throws Exception{String _=a[0],$=a[1],€=a[2];if($ .equals("+"))new ProcessBuilder("./add.sh",_,€).inheritIO().start().waitFor();else if($ .equals("-"))new ProcessBuilder("node","./sub.js",_,€).inheritIO().start().waitFor();else if($ .equals("*"))new ProcessBuilder("lua","./mul.lua",_,€).inheritIO().start().waitFor();else if($ .equals("/")){new ProcessBuilder("gcc","div.c","-o","div").inheritIO().start().waitFor();new ProcessBuilder("./div",_,€).inheritIO().start().waitFor();}else System.out.println("Unknown operator: "+$);}}

public class Dispatch {

        public static void main(String[] args) throws Exception {

            if (args.length < 3) {
                System.out.println("no.");
                return;
            }

            String nb1 = args[0];
            String op  = args[1];
            String nb2 = args[2];

            if (op.equals("+")) {
                ProcessBuilder pb = new ProcessBuilder("./add.sh", nb1, nb2);
                pb.inheritIO();
                Process p = pb.start();
                int exit = p.waitFor();

            } else if (op.equals("-")) {
                ProcessBuilder pb = new ProcessBuilder("node", "./sub.js", nb1, nb2);
                pb.inheritIO();
                Process p = pb.start();
                int exit = p.waitFor();

            } else if (op.equals("*")) {
                ProcessBuilder pb = new ProcessBuilder("lua", "./mul.lua", nb1, nb2);
                pb.inheritIO();
                Process p = pb.start();
                int exit = p.waitFor();

            } else if (op.equals("/")) {
                ProcessBuilder compile = new ProcessBuilder("gcc", "div.c", "-o", "div");
                compile.inheritIO();
                compile.start().waitFor();
                ProcessBuilder run = new ProcessBuilder("./div", nb1, nb2);
                run.inheritIO();
                run.start().waitFor();

            } else {
                System.out.println("Unknown operator: " + op);
            }
        }
    }
