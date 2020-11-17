package assignment;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.PreparedStatement;

public class w11 {
	
	private static String className = "oracle.jdbc.driver.OracleDriver";
	private static String url = "jdbc:oracle:thin:@localhost:1521:xe";
	private static String user = "hr";
	private static String password = "1234";
	
	public Connection getConnection() {
		Connection conn = null;

		try {			
			Class.forName(className);
			conn = DriverManager.getConnection(url, user, password);
			System.out.println("connection completed");						
		} catch (ClassNotFoundException cnfe) {
			System.out.println("failed db driver loading\n" + cnfe.toString());
		} catch (SQLException sqle) {
			System.out.println("failed db connection\n" + sqle.toString());
		} catch (Exception e) {
			System.out.println("Unknown error");
		}
		
		return conn;
	}
	
	public void closeAll(Connection conn, PreparedStatement psmt, ResultSet rs) {
		try {
			if (rs != null) rs.close();
			if (psmt != null) psmt.close();
			if (conn != null) conn.close();
			System.out.println("All closed");
			
		} catch (SQLException sqle) {
			System.out.println("Error!!");
			sqle.printStackTrace();
		}
	}

	private void select() {
		Connection conn = null;
		PreparedStatement psmt = null;
		ResultSet rs = null;
		String sql = "SELECT * FROM countries WHERE country_id = 'KR'";
		try {
			conn = this.getConnection();
			psmt = conn.prepareStatement(sql);
			rs = psmt.executeQuery();
			while(rs.next()) {
				System.out.print("COUNTRY_ID: " + rs.getString("COUNTRY_ID"));
				System.out.print("\tCOUNTRY_NAME: " + rs.getString("COUNTRY_NAME"));
				System.out.println("\tREGION_ID: " + rs.getString("REGION_ID"));

			}			
		} catch(SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn, psmt, rs);
		}
	}

	private void update() {
		Connection conn = null;
		PreparedStatement psmt = null;
		String sql = "UPDATE countries SET COUNTRY_NAME = 'Korea' WHERE COUNTRY_ID = 'KR'";
		
		try {
			conn = this.getConnection();
			psmt = conn.prepareStatement(sql);
			int count = psmt.executeUpdate();
			System.out.println(count + " row updated");			
		} catch(SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn, psmt, null);
		}
	}
	
	private void insert() {
		Connection conn = null;
		PreparedStatement psmt = null;
		String sql = "INSERT INTO countries VALUES ('KR', null, null)";
		
		try {
			conn = this.getConnection();
			psmt = conn.prepareStatement(sql);
			int count = psmt.executeUpdate();
			System.out.println(count + " row inserted");			
		} catch(SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn, psmt, null);
		}
	}
	
	private void delete() {
		Connection conn = null;
		PreparedStatement psmt = null;
		String sql = "DELETE FROM countries WHERE COUNTRY_ID = 'KR'";
		
		try {
			conn = this.getConnection();
			psmt = conn.prepareStatement(sql);
			int count = psmt.executeUpdate();
			System.out.println(count + " row deleted");			
		} catch(SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn, psmt, null);
		}
	}
	
	
	public static void main(String[] args) {		
		w11 so = new w11();
		so.select();
		so.insert();
		so.select();
		so.update();
		so.select();
		so.delete();
		so.select();	
	}
}
